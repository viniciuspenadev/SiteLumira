<?php

class SupabaseHelper
{
    private $url;
    private $anonKey;
    private $authToken;

    public function __construct($url, $key)
    {
        $this->url = $url ? rtrim($url, '/') : '';
        $this->anonKey = $key;
        $this->authToken = $key; // Default to anon auth
    }

    public function setToken($token)
    {
        $this->authToken = $token;
    }

    /**
     * @return mixed
     */
    private function request($endpoint, $method = 'GET', $data = null)
    {
        $url = $this->url . '/rest/v1/' . $endpoint;

        $headers = [
            'apikey: ' . $this->anonKey,
            'Authorization: Bearer ' . $this->authToken,
            'Content-Type: application/json',
            'Prefer: return=representation' // Return the inserted/updated data
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // SSL Verification
        $isLocal = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, !$isLocal);

        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 400) {
            error_log("Supabase Error [$httpCode]: " . $response);
            return null;
        }

        return json_decode($response, true);
    }

    public function createConversation($visitorName = null)
    {
        return $this->request('conversations', 'POST', [
            'visitor_name' => $visitorName,
            'status' => 'active'
        ]);
    }

    public function getConversation($id)
    {
        $result = $this->request("conversations?id=eq.$id&select=*", 'GET');
        return $result ? $result[0] : null;
    }

    public function addMessage($conversationId, $role, $content)
    {
        // Add message
        $msg = $this->request('messages', 'POST', [
            'conversation_id' => $conversationId,
            'role' => $role,
            'content' => $content
        ]);

        // Update conversation timestamp
        $this->request("conversations?id=eq.$conversationId", 'PATCH', [
            'last_message_at' => date('c')
        ]);

        return $msg;
    }

    public function updateSummary($conversationId, $summary)
    {
        return $this->request("conversations?id=eq.$conversationId", 'PATCH', [
            'ai_summary' => $summary
        ]);
    }

    public function getConversations()
    {
        // Order by last_message_at descending
        return $this->request('conversations?select=*&order=last_message_at.desc', 'GET');
    }

    public function getMessages($conversationId)
    {
        // Order by created_at ascending
        return $this->request("messages?conversation_id=eq.$conversationId&select=*&order=created_at.asc", 'GET');
    }

    public function updateVisitorInfo($conversationId, $name, $contact)
    {
        $data = [];
        if ($name)
            $data['visitor_name'] = $name;
        if ($contact)
            $data['visitor_contact'] = $contact;

        if (empty($data))
            return null;

        return $this->request("conversations?id=eq.$conversationId", 'PATCH', $data);
    }

    public function deleteConversation($id)
    {
        // Because of "on delete cascade" in Postgres, 
        // deleting the conversation deletes its messages automatically.
        $this->request("conversations?id=eq.$id", 'DELETE');
    }

    // --- Jobs Managements ---

    public function getJobs($activeOnly = false)
    {
        $query = "jobs?select=*&order=created_at.desc";
        if ($activeOnly) {
            $query .= "&active=eq.true";
        }
        return $this->request($query, 'GET');
    }

    public function getJob($id)
    {
        $result = $this->request("jobs?id=eq.$id&select=*", 'GET');
        return $result ? $result[0] : null;
    }

    public function createJob($data)
    {
        return $this->request('jobs', 'POST', $data);
    }

    public function updateJob($id, $data)
    {
        return $this->request("jobs?id=eq.$id", 'PATCH', $data);
    }

    public function deleteJob($id)
    {
        return $this->request("jobs?id=eq.$id", 'DELETE');
    }

    // --- Applications Management ---

    public function createApplication($data)
    {
        return $this->request('applications', 'POST', $data);
    }

    public function getApplications($jobId)
    {
        return $this->request("applications?job_id=eq.$jobId&select=*&order=created_at.desc", 'GET');
    }
}
?>