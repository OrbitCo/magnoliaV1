<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* helper_firebase.twig */
class __TwigTemplate_2b7aac3b1ce72eee80f2572e3b2210e5e99b9b7ace553826bee14aec07d2971b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ($this->getAttribute(($context["mobile_settings"] ?? null), "use_notifications", [])) {
            // line 2
            echo "    <script src=\"https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js\"></script>
    <script src=\"https://www.gstatic.com/firebasejs/8.6.8/firebase-messaging.js\"></script>
    <script>
        // Initialize Firebase
        let config = {
            apiKey: \"";
            // line 7
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_api_key", []);
            echo "\",
            authDomain: \"";
            // line 8
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_auth_domain", []);
            echo "\",
            databaseURL: \"";
            // line 9
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_database_url", []);
            echo "\",
            projectId: \"";
            // line 10
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_project_id", []);
            echo "\",
            storageBucket: \"";
            // line 11
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_storage_bucket", []);
            echo "\",
            messagingSenderId: \"";
            // line 12
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_messaging_sender_id", []);
            echo "\",
            appId: \"";
            // line 13
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_app_id", []);
            echo "\"
        };
        firebase.initializeApp(config);


        const messaging = firebase.messaging();
        messaging.usePublicVapidKey(\"";
            // line 19
            echo $this->getAttribute(($context["mobile_settings"] ?? null), "firebase_public_vapid_key", []);
            echo "\");

        if ('serviceWorker' in navigator) { 
            navigator.serviceWorker.register(site_url + 'firebase-messaging-sw.js?";
            // line 22
            echo twig_random($this->env, 11111, 99999);
            echo "').then(function(registration) {
                registration.update();
                if (messaging) {
                    messaging.useServiceWorker(registration);
                    messaging.requestPermission().then(function () {
                        setFcmToken();
                    }).catch(function (err) {
                        console.log('Unable to get permission to notify.', err);
                    });
                }  
          }); 
        }

        messaging.onTokenRefresh(function() {
            setFcmToken();
        });

        messaging.onMessage(function(payload) {
            if (typeof(notifications) != 'undefined') {
                let options = {
                    image: site_root + 'application/views/flatty/img/favicon/favicon-32x32.png',
                    title: payload.data.title,
                    text: payload.data.message || '',
                    time: 15000,
                    more: payload.data.link,
                };
                notifications.show(options);
            }
        });

        function setFcmToken() {
            messaging.getToken().then(function(token) {
                if (token) {
                    sendTokenToServer(token);
                } else {
                    sendTokenToServer(false);
                }
            }).catch(function(err) {
                sendTokenToServer(false);
            });
        }

        function sendTokenToServer(token) {
            let deviceId = '';

            if (typeof window.localStorage != 'undefined') {
                deviceId = window.localStorage.getItem('device_id');
                let old = window.localStorage.getItem('fcm_token');
                if (old) {
                    if (old == token) {
                        \$.post(site_url + 'mobile/setFcmRegistrationToken', {registration_id: token, device_id: deviceId});
                        return;
                    } else {
                        \$.post(site_url + 'mobile/deleteFcmRegistrationToken', {registration_id: token, device_id: deviceId});
                    }
                }
                if (!deviceId) {
                    deviceId = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                        let r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                        return v.toString(16);
                    });
                }
                window.localStorage.setItem('device_id', deviceId);
                window.localStorage.setItem('fcm_token', token);
            }
            if (token) {
                \$.post(site_url + 'mobile/setFcmRegistrationToken', {registration_id: token, device_id: deviceId});
            }
        }
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_firebase.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 22,  72 => 19,  63 => 13,  59 => 12,  55 => 11,  51 => 10,  47 => 9,  43 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_firebase.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\mobile\\views\\flatty\\helper_firebase.twig");
    }
}
