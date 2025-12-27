<!-- Auto-Refresh Token Script -->
<script>
    // Auto-refresh Supabase token before it expires
    (function () {
        const sbUrl = '<?= $secrets['SUPABASE_URL'] ?? '' ?>';
        const sbKey = '<?= $secrets['SUPABASE_KEY'] ?? '' ?>';

        if (!sbUrl || !sbKey) {
            console.warn('Supabase credentials not loaded for auto-refresh');
            return;
        }

        const sbClient = window.supabase.createClient(sbUrl, sbKey);

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function updateCookies(session) {
            const isSecure = (window.location.protocol === 'https:');
            const secureFlag = isSecure ? '; Secure' : '';
            const expiresIn = 604800; // 7 days

            document.cookie = `sb_access_token=${session.access_token}; path=/; max-age=${expiresIn}; SameSite=Strict${secureFlag}`;
            document.cookie = `sb_refresh_token=${session.refresh_token}; path=/; max-age=${expiresIn}; SameSite=Strict${secureFlag}`;

            const expiresAt = Date.now() + (expiresIn * 1000);
            document.cookie = `sb_token_expires=${expiresAt}; path=/; max-age=${expiresIn}; SameSite=Strict${secureFlag}`;

            console.log('[Auth] Token refreshed successfully');
        }

        async function refreshToken() {
            const refreshToken = getCookie('sb_refresh_token');
            if (!refreshToken) {
                console.warn('[Auth] No refresh token found');
                return;
            }

            try {
                const { data, error } = await sbClient.auth.refreshSession({
                    refresh_token: refreshToken
                });

                if (error) {
                    console.error('[Auth] Refresh failed:', error.message);
                    // Token expired or invalid - redirect to login
                    window.location.href = 'login.php';
                    return;
                }

                if (data.session) {
                    updateCookies(data.session);
                }
            } catch (err) {
                console.error('[Auth] Refresh error:', err);
            }
        }

        // Check if token needs refresh every 5 minutes
        setInterval(() => {
            const expiresAt = getCookie('sb_token_expires');
            if (!expiresAt) return;

            const timeLeft = parseInt(expiresAt) - Date.now();
            const oneDay = 24 * 60 * 60 * 1000;

            // Refresh if less than 1 day remaining
            if (timeLeft < oneDay) {
                console.log('[Auth] Token expiring soon, refreshing...');
                refreshToken();
            }
        }, 5 * 60 * 1000); // Check every 5 minutes

        // Also refresh on page load if needed
        const expiresAt = getCookie('sb_token_expires');
        if (expiresAt) {
            const timeLeft = parseInt(expiresAt) - Date.now();
            const oneDay = 24 * 60 * 60 * 1000;
            if (timeLeft < oneDay) {
                refreshToken();
            }
        }
    })();
</script>