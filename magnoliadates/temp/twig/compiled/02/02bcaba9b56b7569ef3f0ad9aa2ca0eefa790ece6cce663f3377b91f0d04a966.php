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

/* view_actions.twig */
class __TwigTemplate_9fa94f732809ecafe75c40367a08e21a4de0c2b79e406895e7a1e11f13df6d49 extends \Twig\Template
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
        if (($context["is_owner"] ?? null)) {
            // line 2
            echo "    <dl class=\"dl-horizontal pg-dl-icons menu-actions\">
        ";
            // line 3
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "highlight_in_search", []), "status", [])) {
                // line 4
                echo "            <dd>
                <a onclick=\"";
                // line 5
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("my_profile"                ,"btn_highlight"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo " highlight_in_search_available_view.check_available();\" class=\"link-r-margin\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "highlight_in_search", []), "name", []));
                echo "\">
                    ";
                // line 6
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "highlight_in_search", []), "name", []);
                echo "
                </a>
            </dd>
        ";
            }
            // line 10
            echo "        ";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "up_in_search", []), "status", [])) {
                // line 11
                echo "            <dd>
                <a onclick=\"";
                // line 12
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("my_profile"                ,"btn_lift_up"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo " up_in_search_available_view.check_available();\" class=\"link-r-margin\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "up_in_search", []), "name", []));
                echo "\">
                    ";
                // line 13
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "up_in_search", []), "name", []);
                echo "
                </a>
            </dd>
        ";
            }
            // line 17
            echo "        ";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "hide_on_site", []), "status", [])) {
                // line 18
                echo "            <dd>
                <a onclick=\"";
                // line 19
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("my_profile"                ,"btn_stealth"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo " hide_on_site_available_view.check_available();\" class=\"link-r-margin\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "hide_on_site", []), "name", []));
                echo "\">
                    ";
                // line 20
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "hide_on_site", []), "name", []);
                echo "
                </a>
            </dd>
        ";
            }
            // line 24
            echo "        <script type=\"text/javascript\">
            \$(function () {
                loadScripts(
                        [
                            \"";
            // line 28
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"available_view.js"            ,"path"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "\",
                        ],
                        function () {
                            highlight_in_search_available_view = new available_view({
                                siteUrl: site_url,
                                checkAvailableAjaxUrl: 'users/ajax_available_highlight_in_search/',
                                buyAbilityAjaxUrl: 'users/ajax_activate_highlight_in_search/',
                                buyAbilityFormId: 'ability_form',
                                buyAbilitySubmitId: 'ability_form_submit',
                                success_request: function (message) {
                                    error_object.show_error_block(message, 'success');
                                    locationHref('');
                                },
                                fail_request: function (message) {
                                    error_object.show_error_block(message, 'error');
                                },
                            });
                            up_in_search_available_view = new available_view({
                                siteUrl: site_url,
                                checkAvailableAjaxUrl: 'users/ajax_available_up_in_search/',
                                buyAbilityAjaxUrl: 'users/ajax_activate_up_in_search/',
                                buyAbilityFormId: 'ability_form',
                                buyAbilitySubmitId: 'ability_form_submit',
                                success_request: function (message) {
                                    error_object.show_error_block(message, 'success');
                                    locationHref('');
                                },
                                fail_request: function (message) {
                                    error_object.show_error_block(message, 'error');
                                },
                            });
                            hide_on_site_available_view = new available_view({
                                siteUrl: site_url,
                                checkAvailableAjaxUrl: 'users/ajax_available_hide_on_site/',
                                buyAbilityAjaxUrl: 'users/ajax_activate_hide_on_site/',
                                buyAbilityFormId: 'ability_form',
                                buyAbilitySubmitId: 'ability_form_submit',
                                success_request: function (message) {
                                    error_object.show_error_block(message, 'success');
                                    locationHref('');
                                },
                                fail_request: function (message) {
                                    error_object.show_error_block(message, 'error');
                                },
                            });
                        },
                        ['highlight_in_search_available_view', 'up_in_search_available_view', 'hide_on_site_available_view'],
                        {async: false}
                );
            });
        </script>
    </dl>
";
        } else {
            // line 81
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("friendlist"            ,"favorites"            ,"mailbox"            ,"chats"            ,"winks"            ,"kisses"            ,"associations"            ,"questions"            ,"send_money"            ,"send_vip"            ,"virtual_gifts"            ,"blacklist"            ,"twilio_chat"            ,"spam"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            $context['is_module_installed'] = $result;
            // line 95
            echo "    <div id=\"user_menu_actions\" class=\"dl-horizontal pg-dl-icons menu-actions\">
        ";
            // line 96
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "twilio_chat", [])) {
                // line 97
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'twilio_chat';
                $name =                 'videoButton';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 99
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) {
                // line 100
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'friendlist';
                $name =                 'friendlist_links';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 102
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "favorites", [])) {
                // line 103
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'favorites';
                $name =                 'favorites_button';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 105
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "chats", [])) {
                // line 106
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'chats';
                $name =                 'helper_btn_chat';
                $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 108
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "winks", [])) {
                // line 109
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'winks';
                $name =                 'wink';
                $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 111
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "kisses", [])) {
                // line 112
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'kisses';
                $name =                 'kisses_list';
                $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 114
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "associations", [])) {
                // line 115
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'associations';
                $name =                 'associationsQuickButton';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 117
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "questions", [])) {
                // line 118
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'questions';
                $name =                 'questions_list';
                $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 120
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "send_money", [])) {
                // line 121
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'send_money';
                $name =                 'sendMoneyLink';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 123
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "send_vip", [])) {
                // line 124
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'send_vip';
                $name =                 'sendVipLink';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 126
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "virtual_gifts", [])) {
                // line 127
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'virtual_gifts';
                $name =                 'send_gift';
                $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link", "is_main_menu_actions" => 1]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 129
            echo "        <hr align=\"center\" width=\"100%\" style=\"background: #ccc; margin-top: 10px; margin-bottom: 10px;\" />
        ";
            // line 130
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "blacklist", [])) {
                // line 131
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'blacklist';
                $name =                 'blacklist_button';
                $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 133
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "spam", [])) {
                // line 134
                echo "            <span data-action=\"set-user_menu_actions\">";
                $module =                 null;
                $helper =                 'spam';
                $name =                 'mark_as_spam_block';
                $params = array(["object_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "type_gid" => "users_object", "view_type" => "link"]                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</span>
        ";
            }
            // line 136
            echo "    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "view_actions.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  618 => 136,  593 => 134,  590 => 133,  565 => 131,  563 => 130,  560 => 129,  535 => 127,  532 => 126,  507 => 124,  504 => 123,  479 => 121,  476 => 120,  451 => 118,  448 => 117,  423 => 115,  420 => 114,  395 => 112,  392 => 111,  367 => 109,  364 => 108,  339 => 106,  336 => 105,  311 => 103,  308 => 102,  283 => 100,  280 => 99,  255 => 97,  253 => 96,  250 => 95,  229 => 81,  154 => 28,  148 => 24,  141 => 20,  116 => 19,  113 => 18,  110 => 17,  103 => 13,  78 => 12,  75 => 11,  72 => 10,  65 => 6,  40 => 5,  37 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view_actions.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/view_actions.twig");
    }
}
