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

/* settings.twig */
class __TwigTemplate_1674e31cbd41e0f01e17f45c225faee2ab8df417d28fb3179b912a2e05bcd43b extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "settings.twig", 1)->display($context);
        // line 2
        echo "<div class=\"col-xs-12\">
    <h1>";
        // line 3
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("header_text"        ,        );
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
        echo "</h1>
</div>
<div class=\"info-content\">
    <div class=\"col-xs-12 col-md-3\">
        <div class=\"inside account_menu\">
            ";
        // line 8
        $module =         null;
        $helper =         'users';
        $name =         'menuSettings';
        $params = array(["page" => ($context["page"] ?? null), "user" => ($context["user"] ?? null)]        ,        );
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
        // line 9
        echo "        </div>
    </div>
    <div class=\"col-xs-12 col-md-9 content-page\">
        <div class=\"info-content-block\">
            ";
        // line 13
        if (($this->getAttribute(($context["page"] ?? null), "gid", []) == "adult")) {
            // line 14
            echo "                <h1>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_menu_settings_adult"            ,"users"            ,            );
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
            echo "</h1>
                <form action=\"\" method=\"post\" class=\"form-horizontal\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <input type=\"hidden\" name=\"show_adult\" value=\"0\">
                            <input type=\"checkbox\" name=\"show_adult\" id=\"show_adult\" value=\"1\" ";
            // line 19
            if ($this->getAttribute(($context["user"] ?? null), "show_adult", [])) {
                echo "checked";
            }
            echo ">
                            ";
            // line 20
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_show_adult"            ,"users"            ,            );
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
            // line 21
            echo "                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_save\" value=\"";
            // line 25
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\">
                        </div>
                    </div>
                </form>
            ";
        } elseif (($this->getAttribute(        // line 29
($context["page"] ?? null), "gid", []) == "notifications")) {
            // line 30
            echo "                ";
            echo ($context["not_valid_email_show"] ?? null);
            echo "
                ";
            // line 31
            $module =             null;
            $helper =             'notifications';
            $name =             'notificationsList';
            $params = array(            );
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
            // line 32
            echo "                ";
            $module =             null;
            $helper =             'start';
            $name =             'notificationsList';
            $params = array(            );
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
            // line 33
            echo "            ";
        } elseif (($this->getAttribute(($context["page"] ?? null), "gid", []) == "subscriptions")) {
            // line 34
            echo "                <h1>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_menu_settings_subscriptions"            ,"users"            ,            );
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
            echo "</h1>
                ";
            // line 35
            $module =             null;
            $helper =             'subscriptions';
            $name =             'getUserSubscriptionsForm';
            $params = array("account"            ,            );
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
            // line 36
            echo "            ";
        } elseif (($this->getAttribute(($context["page"] ?? null), "gid", []) == "download_my_data")) {
            // line 37
            echo "                ";
            $module =             null;
            $helper =             'user_information';
            $name =             'downloadPage';
            $params = array(            );
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
            // line 38
            echo "            ";
        } elseif (($this->getAttribute(($context["page"] ?? null), "gid", []) == "delete_account")) {
            // line 39
            echo "                <h1>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("delete_account"            ,"users"            ,            );
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
            echo "</h1>
                <div class=\"form-group\">
                    ";
            // line 41
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_delete_confirm"            ,"users"            ,            );
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
            // line 42
            echo "                </div>
                <div class=\"form-group\">
                    <a class=\"btn btn-primary\" onclick=\"ability_delete_available_view.check_available();\">
                        ";
            // line 45
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("delete_account"            ,"users"            ,            );
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
            // line 46
            echo "                    </a>
                </div>
                <script>
                    \$(function () {
                        loadScripts(
                                \"";
            // line 51
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
                                function () {
                                    ability_delete_available_view = new available_view({
                                        siteUrl: site_url,
                                        checkAvailableAjaxUrl: 'users/ajax_available_ability_delete/',
                                        buyAbilityAjaxUrl: 'users/ajax_activate_ability_delete/',
                                        buyAbilityFormId: 'ability_form',
                                        buyAbilitySubmitId: 'ability_form_submit',
                                        formType: 'list',
                                        alert_type: 'delete_profile',
                                        alert_ok_button: '";
            // line 61
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_confirm_delete_profile"            ,"users"            ,""            ,"js"            ,            );
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
            echo "',
                                        alert_cancel_button: '";
            // line 62
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_not_confirm_delete_profile"            ,"users"            ,""            ,"js"            ,            );
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
            echo "',
                                        lang_delete_confirm: '";
            // line 63
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_delete_confirm"            ,"users"            ,""            ,"js"            ,            );
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
            echo "',
                                        success_request: function (data) {
                                            locationHref(data.content);
                                        },
                                        fail_request: function (message) {
                                            error_object.show_error_block(message, 'error');
                                        },
                                    });
                                },
                                ['ability_delete_available_view'],
                                {async: false}
                        );
                    });
                </script>
            ";
        } elseif (($this->getAttribute(        // line 77
($context["page"] ?? null), "gid", []) == "email")) {
            // line 78
            echo "                <h1>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_menu_settings_email"            ,"users"            ,            );
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
            echo "</h1>
                <form action=\"\" method=\"post\" class=\"form-horizontal\">
                    <div class=\"form-group\">
                        <label for=\"email\"  class=\"col-xs-12 tali\">
                            ";
            // line 82
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_email"            ,"users"            ,            );
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
            echo ":
                        </label>
                        <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                            <input type=\"email\" name=\"email\" value=\"";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "email", []));
            echo "\" class=\"form-control\">
                        </div>
                    </div>
                    ";
            // line 96
            echo "                    ";
            if ((($this->getAttribute(($context["user"] ?? null), "changed_email", []) &&  !$this->getAttribute(($context["user"] ?? null), "valid_email", [])) && $this->getAttribute(($context["user"] ?? null), "confirm_code_new_email", []))) {
                // line 97
                echo "                        <div class=\"form-group\">
                            <label for=\"changed_email\"  class=\"col-xs-12 tali\">
                                ";
                // line 99
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("email_confirmation_code"                ,"users"                ,                );
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
                echo ":
                            </label>
                            <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                                <input type=\"text\" name=\"email_confirmation_code\" class=\"form-control\">
                            </div>
                        </div>
                    ";
            }
            // line 105
            echo "    
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_contact_save\" value=\"";
            // line 108
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\">
                        </div>
                    </div>
                </form>
                <div>
                    <form action=\"\" method=\"post\" class=\"form-horizontal\">
                        <div class=\"form-group\">
                            <label for=\"password\"  class=\"col-xs-12 tali\">
                                ";
            // line 116
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_password"            ,"users"            ,            );
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
            echo ":
                            </label>
                            <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                                <input type=\"password\" name=\"password\" class=\"form-control\">
                            </div>
                        </div>
                        ";
            // line 122
            if ( !twig_test_empty(($context["use_repassword"] ?? null))) {
                // line 123
                echo "                            <div class=\"form-group\">
                                <label for=\"repassword\"  class=\"col-xs-12 tali\">
                                    ";
                // line 125
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_repassword"                ,"users"                ,                );
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
                echo ":
                                </label>
                                <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                                    <input type=\"password\" name=\"repassword\" class=\"form-control\">
                                </div>
                            </div>
                        ";
            }
            // line 132
            echo "                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_password_save\" value=\"";
            // line 134
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\">
                            </div>
                        </div>
                    </form>
                </div>
            ";
        }
        // line 140
        echo "        </div>
    </div>
</div>

";
        // line 144
        $this->loadTemplate("@app/footer.twig", "settings.twig", 144)->display($context);
    }

    public function getTemplateName()
    {
        return "settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  729 => 144,  723 => 140,  695 => 134,  691 => 132,  662 => 125,  658 => 123,  656 => 122,  628 => 116,  598 => 108,  593 => 105,  564 => 99,  560 => 97,  557 => 96,  551 => 85,  526 => 82,  499 => 78,  497 => 77,  461 => 63,  438 => 62,  415 => 61,  383 => 51,  376 => 46,  355 => 45,  350 => 42,  329 => 41,  304 => 39,  301 => 38,  279 => 37,  276 => 36,  255 => 35,  231 => 34,  228 => 33,  206 => 32,  185 => 31,  180 => 30,  178 => 29,  152 => 25,  146 => 21,  125 => 20,  119 => 19,  91 => 14,  89 => 13,  83 => 9,  62 => 8,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "settings.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\settings.twig");
    }
}
