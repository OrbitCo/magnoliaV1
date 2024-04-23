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

/* user_preview.twig */
class __TwigTemplate_f8856988445104dc2ec7252cf26ac0a5fe5123ab0a735b68bd9227f2542f1d63 extends \Twig\Template
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
        echo "<div class=\"user_preview-js\">
    ";
        // line 2
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("access_permissions"        ,"chatbox"        ,        );
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
        // line 3
        echo "    ";
        if ((($context["is_owner"] ?? null) && (($context["sidebar"] ?? null) == "main"))) {
            // line 4
            echo "        <div class=\"sidebar-block g-col\">
            <div class=\"preview-block\">
                <div class=\"col-md-3 col-lg-3 no-padding-left\">
                    <div class=\"image\">
                        ";
            // line 8
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ($context["data"] ?? null), "size" => "small", "class" => "img-rounded img-responsive"]            ,            );
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
            echo "                    </div>
                </div>
                <div class=\"col-md-9 col-lg-9\">
                    <div class=\"user-description\">
                        <div class=\"strong-username\">";
            // line 13
            echo $this->getAttribute(($context["data"] ?? null), "output_name", []);
            echo ",&nbsp;";
            echo $this->getAttribute(($context["data"] ?? null), "age", []);
            echo "</div>
                        ";
            // line 14
            if ($this->getAttribute(($context["data"] ?? null), "location", [])) {
                echo "<div><i class=\"fas fa-map-marker-alt\"></i>&nbsp;";
                echo $this->getAttribute(($context["data"] ?? null), "city", []);
                echo "</div>";
            }
            // line 15
            echo "                        <div>
                            <a class=\"link-r-margin\" title=\"";
            // line 16
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("edit_my_profile"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\" href=\"";
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"profile"            ,["section-code" => "personal", "section-name" => ($context["personal_section_name"] ?? null)]            ,            );
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
                                <i class=\"fas fa-pencil-alt\"></i>&nbsp;";
            // line 17
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("edit_my_profile"            ,"start"            ,            );
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
            // line 18
            echo "                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"user-homapage-menu\">
                ";
            // line 24
            $module =             null;
            $helper =             'menu';
            $name =             'get_menu';
            $params = array("user_homepage_menu"            ,"user_homepage_menu"            ,            );
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
            // line 25
            echo "            </div>
        </div>
    ";
        } else {
            // line 28
            echo "        <div class=\"media pg-media g-col fix-overflow-js\">

            <div class=\"g-users-gallery__content\">
                <a id=\"user_photo\" class=\"g-rounded g-pic-border full-width\">
                    ";
            // line 32
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ($context["data"] ?? null), "size" => "great", "class" => "img-rounded img-responsive full-width"]            ,            );
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
            echo "                </a>
                ";
            // line 34
            if (($context["is_owner"] ?? null)) {
                // line 35
                echo "                    <div class=\"change-photo-button photo-action-js owner-change-photo\">
                        ";
                // line 36
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_change_photo"                ,"media"                ,                );
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
                // line 37
                echo "                    </div>
                ";
            }
            // line 39
            echo "                <div class=\"view-photo-button photo-action-js\">
                    ";
            // line 40
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_view_photo"            ,"media"            ,            );
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
            // line 41
            echo "                </div>
            </div>



            <div class=\"pg-media-body user-all-description\">
                <h1>";
            // line 47
            echo $this->getAttribute(($context["data"] ?? null), "output_name", []);
            echo "
                    ";
            // line 48
            if (($context["is_owner"] ?? null)) {
                // line 49
                echo "                        <span class=\"ml10 pg-dl-icons\">
                            <a class=\"link-r-margin\" title=\"";
                // line 50
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("edit_my_profile"                ,"start"                ,""                ,"button"                ,                );
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
                echo "\"
                               href=\"";
                // line 51
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"profile"                ,"view"                ,                );
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
                                <i class=\"fas fa-pencil-alt hover\"></i>
                            </a>
                        </span>
                    ";
            }
            // line 56
            echo "                </h1>
                <div class=\"user-description mb10\">
                    <div class=\"mb10  js-user-status\">
                        <div class=\"online hide\">
                            <i class=\"far fa-clock\"></i>&nbsp;";
            // line 60
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("status_online_1"            ,"users"            ,            );
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
            // line 61
            echo "                        </div>
                        <div class=\"offline hide\">
                            <div class=\"last_activity\">
                            </div>
                            <div class=\"status\">
                                <i class=\"far fa-clock\"></i>&nbsp;";
            // line 66
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("status_online_0"            ,"users"            ,            );
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
            // line 67
            echo "                            </div>
                        </div>
                        <div class=\"status-page\">
                            ";
            // line 70
            if (($this->getAttribute(($context["data"] ?? null), "online_status", []) == 0)) {
                // line 71
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_last_seen"                ,"users"                ,                );
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
                echo " ";
                $module =                 null;
                $helper =                 'date_format';
                $name =                 'tpl_date_format';
                $params = array($this->getAttribute(($context["data"] ?? null), "date_last_activity", [])                ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                ,                );
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
                // line 72
                echo "                            ";
            } else {
                // line 73
                echo "                                <i class=\"far fa-clock\"></i>&nbsp;";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "statuses", []), "online_status_lang", []);
                echo "
                            ";
            }
            // line 75
            echo "                        </div>
                    </div>
                    <div class=\"clearfix\"><span class=\"pull-left\">";
            // line 77
            echo $this->getAttribute(($context["data"] ?? null), "age", []);
            echo " ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_age"            ,"users"            ,            );
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
            echo "</span> ";
            $module =             null;
            $helper =             'horoscope';
            $name =             'getSignHoroscope';
            $params = array(["user" => ($context["data"] ?? null)]            ,            );
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
            echo "</div>

                    <div>
                        <span ";
            // line 80
            if (($context["is_owner"] ?? null)) {
                echo "class=\"border-b-dashed pointer\" data-change=\"location\"";
            }
            echo ">
                            <i class=\"fas fa-map-marker-alt\"></i>&nbsp;
                            ";
            // line 82
            if ($this->getAttribute(($context["data"] ?? null), "location", [])) {
                // line 83
                echo "                                ";
                echo $this->getAttribute(($context["data"] ?? null), "location", []);
                echo "
                            ";
            } else {
                // line 85
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_select_region"                ,"countries"                ,                );
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
                // line 86
                echo "                            ";
            }
            // line 87
            echo "                        </span>
                    </div>
                </div>
                <div class=\"form-group\">
                    ";
            // line 91
            if (($context["is_owner"] ?? null)) {
                // line 92
                echo "                        ";
                $module =                 null;
                $helper =                 'users';
                $name =                 'servicesButton';
                $params = array(["data" => ($context["data"] ?? null)]                ,                );
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
                // line 93
                echo "                    ";
            } else {
                // line 94
                echo "                        <div class=\"services-owner-menu ";
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "chatbox", [])) {
                    echo "short";
                } else {
                    echo "long";
                }
                echo "\">
                            ";
                // line 95
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "chatbox", [])) {
                    // line 96
                    echo "                                <span class=\"col-xs-10 col-sm-9\">
                                    ";
                    // line 97
                    $module =                     null;
                    $helper =                     'chatbox';
                    $name =                     'send_message_chatbox';
                    $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "button", "text_type" => "chat", "class" => "btn btn-primary ellipsis"]                    ,                    );
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
                    // line 98
                    echo "                                </span>
                                <span class=\"col-xs-2 col-sm-3\">
                                    <button id=\"services-menu\" type=\"button\" class=\"btn btn-default btn-block\" onclick=\"sendAnalytics('dp_user_view_profile_btn_services_menu', 'user_profile', 'btn_services_menu');\" data-toggle=\"dropdown\">
                                        <i class=\"fa fa-ellipsis-h\"></i>
                                    </button>
                                </span>
                            ";
                } else {
                    // line 105
                    echo "                                <button id=\"services-menu\" type=\"button\" class=\"btn btn-default btn-block\" onclick=\"sendAnalytics('dp_user_view_profile_btn_services_menu', 'user_profile', 'btn_services_menu');\" data-toggle=\"dropdown\">
                                    <i class=\"fa fa-ellipsis-h\"></i>
                                </button>
                            ";
                }
                // line 109
                echo "                        </div>
                    ";
            }
            // line 111
            echo "                    <div class=\"hide service-menu-view\" id=\"services-menu_template\" class=\"services-menu_content\">
                        <div class=\"arrow_box\"></div>
                        ";
            // line 113
            $this->loadTemplate("view_actions.twig", "user_preview.twig", 113)->display(twig_array_merge($context, ["is_owner" => ($context["is_owner"] ?? null)]));
            // line 114
            echo "                    </div>
                </div>
                <script type=\"text/javascript\">
                    \$(document).mouseup(function (e){
                        var div = \$(\"#services-menu\");
                        if (!div.is(e.target)
                            && div.has(e.target).length === 0) {
                            \$('#services-menu_template').addClass('hide');
                        }
                    });
                </script>
                ";
            // line 125
            if (($context["is_owner"] ?? null)) {
                // line 126
                echo "                    <div class=\"dl-horizontal pg-dl-icons menu-actions pb20\">
                        ";
                // line 127
                $module =                 null;
                $helper =                 'referral_links';
                $name =                 'referral_link';
                $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "link_icon"]                ,                );
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
                // line 128
                echo "                    </div>
                ";
            }
            // line 130
            echo "                <script>
                    \$(function () {
                        loadScripts(
                            [\"";
            // line 133
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("users"            ,"../views/flatty/js/users-avatar.js"            ,"path"            ,            );
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
                                \"";
            // line 134
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("users"            ,"users-settings.js"            ,"path"            ,            );
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
            echo "\"],
                            function () {
                                user_avatar = new UsersAvatar({
                                    site_url: site_url,
                                    id_user:";
            // line 138
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo " ,
                                    saveAfterSelect: false,
                                    haveAvatar: '";
            // line 140
            echo $this->getAttribute(($context["data"] ?? null), "have_avatar", []);
            echo "',
                                    callback: function () {
                                        (new usersSettings({siteUrl: site_url})).rebuild('user_logo');
                                    }
                                });
                                changeLocation = new usersSettings({
                                    siteUrl: site_url,
                                    langs: {
                                        link_select_region: \"";
            // line 148
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_select_region"            ,"countries"            ,            );
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
            echo "\"
                                    }
                                });
                            },
                            ['user_avatar', 'changeLocation'],
                            {async: false}
                        );
                    });
                </script>
            </div>
        </div>
    ";
        }
        // line 160
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "user_preview.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  801 => 160,  767 => 148,  756 => 140,  751 => 138,  725 => 134,  702 => 133,  697 => 130,  693 => 128,  672 => 127,  669 => 126,  667 => 125,  654 => 114,  652 => 113,  648 => 111,  644 => 109,  638 => 105,  629 => 98,  608 => 97,  605 => 96,  603 => 95,  594 => 94,  591 => 93,  569 => 92,  567 => 91,  561 => 87,  558 => 86,  536 => 85,  530 => 83,  528 => 82,  521 => 80,  473 => 77,  469 => 75,  463 => 73,  460 => 72,  417 => 71,  415 => 70,  410 => 67,  389 => 66,  382 => 61,  361 => 60,  355 => 56,  328 => 51,  305 => 50,  302 => 49,  300 => 48,  296 => 47,  288 => 41,  267 => 40,  264 => 39,  260 => 37,  239 => 36,  236 => 35,  234 => 34,  231 => 33,  210 => 32,  204 => 28,  199 => 25,  178 => 24,  170 => 18,  149 => 17,  105 => 16,  102 => 15,  96 => 14,  90 => 13,  84 => 9,  63 => 8,  57 => 4,  54 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_preview.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/user_preview.twig");
    }
}
