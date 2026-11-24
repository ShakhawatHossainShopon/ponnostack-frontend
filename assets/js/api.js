/**
 * Reusable Client Storefront API Client (JavaScript)
 * 
 * Reusable wrapper around Fetch API preconfigured with Mother Platform Base URL
 * and Storefront UUID.
 */

if (typeof window.StoreApi === 'undefined') {
    window.StoreApi = (function() {
        let _apiUrl = 'http://localhost/my-ecommerce/mother/api';
        let _storeUuid = '';
        let _token = localStorage.getItem('store_token') || '';

        return {
            /**
             * Initialize Store API settings
             */
            init: function(config) {
                if (config.apiUrl) _apiUrl = config.apiUrl.replace(/\/+$/, '');
                if (config.storeUuid) _storeUuid = config.storeUuid;
                if (config.token) _token = config.token;
            },

            setToken: function(token) {
                _token = token;
                if (token) {
                    localStorage.setItem('store_token', token);
                } else {
                    localStorage.removeItem('store_token');
                }
            },

            getToken: function() {
                return _token || localStorage.getItem('store_token') || '';
            },

            getStoreUuid: function() {
                return _storeUuid;
            },

            /**
             * Generic Request Method
             */
            request: async function(method, endpoint, data = null) {
                const cleanEndpoint = endpoint.replace(/^\/+/, '');
                let url = `${_apiUrl}/${cleanEndpoint}`;

                const headers = {
                    'Accept': 'application/json'
                };

                if (_storeUuid) {
                    headers['X-Store-UUID'] = _storeUuid;
                    headers['X-Tenant-UUID'] = _storeUuid;
                }

                const token = this.getToken();
                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }

                const options = {
                    method: method.toUpperCase(),
                    headers: headers
                };

                if (data && (['POST', 'PUT', 'PATCH'].includes(method.toUpperCase()))) {
                    if (data instanceof FormData) {
                        options.body = data;
                    } else {
                        headers['Content-Type'] = 'application/json';
                        options.body = JSON.stringify(data);
                    }
                } else if (data && method.toUpperCase() === 'GET') {
                    const query = new URLSearchParams(data).toString();
                    if (query) url += `?${query}`;
                }

                try {
                    const response = await fetch(url, options);
                    const json = await response.json();
                    return {
                        status: response.status,
                        ok: response.ok,
                        ...json
                    };
                } catch (err) {
                    console.error(`StoreApi Error [${method} ${endpoint}]:`, err);
                    return {
                        success: false,
                        message: 'Network error or Mother API unavailable',
                        error: err.message
                    };
                }
            },

            get: function(endpoint, params = null) {
                return this.request('GET', endpoint, params);
            },

            post: function(endpoint, body = null) {
                return this.request('POST', endpoint, body);
            },

            put: function(endpoint, body = null) {
                return this.request('PUT', endpoint, body);
            },

            delete: function(endpoint) {
                return this.request('DELETE', endpoint);
            }
        };
    })();
}
var StoreApi = window.StoreApi;
