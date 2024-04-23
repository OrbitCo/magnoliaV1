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

/* view_magazine.twig */
class __TwigTemplate_a9509afdad00a03fca97752a227fccac0be34aa10e57f118b43a926564f290ed extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "view_magazine.twig", 1)->display($context);
        // line 2
        echo "</div></div>

";
        // line 4
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("geomap"        ,        );
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
        // line 5
        echo "
<div class=\"magazine-profile\">
    ";
        // line 7
        if ((((($context["profile_section"] ?? null) == "") || (($context["profile_section"] ?? null) == "profile")) || (($context["profile_section"] ?? null) == "wall"))) {
            // line 8
            echo "        <div class=\"magazine-profile__media mag-portrait\">
            <div class=\"magazine-profile__avabg\" style=\"background: url(";
            // line 9
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "thumbs", []), "middle", []);
            echo ") no-repeat center / cover;\"></div>
            <div class=\"magazine-profile__ava\">
                <a id=\"user_photo\" data-profile_id='";
            // line 11
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "'>
                    ";
            // line 12
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ($context["data"] ?? null), "size" => "grand", "get_original_file_url" => 0, "class" => "img-responsive"]            ,            );
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
            // line 13
            echo "                </a>

                ";
            // line 15
            if (($context["is_owner"] ?? null)) {
                // line 16
                echo "                    <div class=\"change-photo-button photo-action-js owner-change-photo\">
                        ";
                // line 17
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
                // line 18
                echo "                    </div>
                ";
            }
            // line 20
            echo "                <div class=\"view-photo-button photo-action-js\">
                    ";
            // line 21
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
            // line 22
            echo "                </div>

                <script>
                    \$(function () {
                        loadScripts(
                                [\"";
            // line 27
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
            echo "\"],
                                function () {
                                    user_avatar = new UsersAvatar({
                                        site_url: site_url,
                                        id_user:";
            // line 31
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo " ,
                                        saveAfterSelect: false,
                                        haveAvatar: '";
            // line 33
            echo $this->getAttribute(($context["data"] ?? null), "have_avatar", []);
            echo "',
                                        callback: function () {
                                            (new usersSettings({siteUrl: site_url})).rebuild('user_logo');
                                        }
                                    });
                                },
                                ['user_avatar'],
                                {async: false}
                        );
                    });
                </script>
            </div>
            <div class=\"magazine-profile__status\">
                ";
            // line 46
            if (($this->getAttribute(($context["data"] ?? null), "online_status", []) == 0)) {
                // line 47
                echo "                    ";
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
                // line 48
                echo "                ";
            } else {
                // line 49
                echo "                    ";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "statuses", []), "online_status_lang", []);
                echo "
                ";
            }
            // line 51
            echo "            </div>
            <div class=\"magazine-profile__recentmedia\">
                ";
            // line 53
            $module =             null;
            $helper =             'media';
            $name =             'user_media_block';
            $params = array(["count" => 3, "user_id" => ($context["user_id"] ?? null), "media_size" => "middle", "template" => "magazine"]            ,            );
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
            // line 54
            echo "            </div>
        </div>

        <div class=\"magazine-profile__text\">
            <div class=\"magazine-profile__content\">

                ";
            // line 60
            if (((($context["profile_section"] ?? null) == "") || (($context["profile_section"] ?? null) == "profile"))) {
                // line 61
                echo "                    <div class=\"magazine-profile__tabs\">
                        ";
                // line 62
                $this->loadTemplate("view_profile_menu.twig", "view_magazine.twig", 62)->display(twig_array_merge($context, ["template" => "magazine"]));
                // line 63
                echo "                    </div>

                    ";
                // line 65
                $this->loadTemplate("profile_top_magazine.twig", "view_magazine.twig", 65)->display($context);
                // line 66
                echo "
                    <div class=\"magazine-profile__base\">
                        ";
                // line 68
                echo $this->getAttribute(($context["data"] ?? null), "user_type_str", []);
                echo ",
                        ";
                // line 69
                $module =                 null;
                $helper =                 'utils';
                $name =                 'depends';
                $params = array("horoscope"                ,"perfect_match"                ,                );
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
                // line 70
                echo "                        ";
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "horoscope", [])) {
                    $module =                     null;
                    $helper =                     'horoscope';
                    $name =                     'getSignHoroscope';
                    $params = array(["user" => ($context["data"] ?? null), "template" => "text"]                    ,                    );
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
                    $context['sign_horoscope'] = $result;
                    if ( !twig_test_empty(($context["sign_horoscope"] ?? null))) {
                        echo ($context["sign_horoscope"] ?? null);
                        echo ",";
                    }
                }
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "perfect_match", [])) {
                    echo " <span>";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_looking_user_type_profile"                    ,"users"                    ,                    );
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
                    // line 71
                    echo "                        ";
                    echo $this->getAttribute(($context["data"] ?? null), "looking_user_type_str", []);
                    echo "</span> ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_aged"                    ,"users"                    ,                    );
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
                    echo "                        ";
                    if ($this->getAttribute(($context["data"] ?? null), "age_min", [])) {
                        echo $this->getAttribute(($context["data"] ?? null), "age_min", []);
                    }
                    if (($this->getAttribute(($context["data"] ?? null), "age_min", []) && $this->getAttribute(($context["data"] ?? null), "age_max", []))) {
                        echo "-";
                    }
                    if ($this->getAttribute(($context["data"] ?? null), "age_max", [])) {
                        echo $this->getAttribute(($context["data"] ?? null), "age_max", []);
                    }
                    // line 73
                    echo "                        ";
                }
                // line 74
                echo "                    </div>

                    ";
                // line 76
                if ( !($context["is_owner"] ?? null)) {
                    // line 77
                    echo "                        <div class=\"magazine-profile__actions\">
                            ";
                    // line 78
                    if ((($context["auth_type"] ?? null) == "user")) {
                        // line 79
                        echo "                                ";
                        $module =                         null;
                        $helper =                         'utils';
                        $name =                         'depends';
                        $params = array("access_permissions"                        ,"ratings"                        ,"chatbox"                        ,"chats"                        ,                        );
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
                        // line 80
                        echo "
                                ";
                        // line 81
                        if ($this->getAttribute(($context["is_module_installed"] ?? null), "chatbox", [])) {
                            // line 82
                            echo "                                    ";
                            $module =                             null;
                            $helper =                             'chatbox';
                            $name =                             'send_message_chatbox';
                            $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "button", "text_type" => "chat", "class" => "btn btn-primary ellipsis"]                            ,                            );
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
                            // line 83
                            echo "                                ";
                        }
                        // line 84
                        echo "                                ";
                        if ($this->getAttribute(($context["is_module_installed"] ?? null), "chats", [])) {
                            // line 85
                            echo "                                    ";
                            $module =                             null;
                            $helper =                             'chats';
                            $name =                             'helperBtnChat';
                            $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "view_type" => "button", "class" => "btn btn-primary ellipsis"]                            ,                            );
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
                            echo "                                ";
                        }
                        // line 87
                        echo "                                <span id=\"service-menu_block\">
                                    <button id=\"services-menu\" type=\"button\" class=\"btn btn-default\" data-toggle=\"popover\">
                                        <i class=\"fa fa-ellipsis-h\"></i>&nbsp;";
                        // line 89
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_more"                        ,"users"                        ,                        );
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
                        // line 90
                        echo "                                    </button>
                                </span>
                                <div class=\"hide\" id=\"services-menu_template\" class=\"services-menu_content\">
                                    ";
                        // line 93
                        $this->loadTemplate("view_actions.twig", "view_magazine.twig", 93)->display(twig_array_merge($context, ["is_owner" => ($context["is_owner"] ?? null)]));
                        // line 94
                        echo "                                </div>


                            ";
                    } else {
                        // line 98
                        echo "                                <button onclick=\"javascript: \$('#ajax_login_link').click();\" class=\"btn btn-primary ellipsis\">
                                    ";
                        // line 99
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("chat_now"                        ,"chatbox"                        ,                        );
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
                        // line 100
                        echo "                                </button>
                                <button type=\"button\" class=\"btn btn-default\" onclick=\"javascript: \$('#ajax_login_link').click();\">
                                    <i class=\"fa fa-ellipsis-h\"></i>&nbsp;";
                        // line 102
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_more"                        ,"users"                        ,                        );
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
                        // line 103
                        echo "                                </button>
                            ";
                    }
                    // line 105
                    echo "                        </div>

                        <div class=\"magazine-profile__gifts clearfix\">
                            <div class=\"user-gifts-block\">
                                <div class=\"media-items\">
                            ";
                    // line 110
                    $module =                     null;
                    $helper =                     'virtual_gifts';
                    $name =                     'user_gifts_block';
                    $params = array(["id_wall" => $this->getAttribute(($context["data"] ?? null), "id", []), "is_mine" => "false", "template" => "magazine"]                    ,                    );
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
                    // line 111
                    echo "                            ";
                    $module =                     null;
                    $helper =                     'virtual_gifts';
                    $name =                     'send_gift';
                    $params = array(["user_id" => $this->getAttribute(($context["data"] ?? null), "id", []), "template" => "magazine"]                    ,                    );
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
                    // line 112
                    echo "                            </div>
                            </div>
                        </div>
                    ";
                } else {
                    // line 116
                    echo "                        <div class=\"magazine-profile__gifts clearfix\">
                            ";
                    // line 117
                    $module =                     null;
                    $helper =                     'virtual_gifts';
                    $name =                     'user_gifts_block';
                    $params = array(["id_wall" => $this->getAttribute(($context["data"] ?? null), "id", []), "is_mine" => "true", "template" => "magazine"]                    ,                    );
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
                    // line 118
                    echo "                        </div>
                    ";
                }
                // line 120
                echo "
                    <div class=\"magazine-profile__params\">
                        ";
                // line 122
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 123
                    echo "                            ";
                    ob_start(function () { return ''; });
                    // line 124
                    echo "                                ";
                    $this->loadTemplate("custom_view_fields.twig", "view_magazine.twig", 124)->display(twig_array_merge($context, ["fields_data" => $this->getAttribute($context["item"], "fields", []), "is_owner" => false]));
                    // line 125
                    echo "                            ";
                    $context["view_fields"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                    // line 126
                    echo "                            ";
                    if (twig_trim_filter(($context["view_fields"] ?? null))) {
                        // line 127
                        echo "                                <div class=\"view-section\">
                                    ";
                        // line 128
                        echo ($context["view_fields"] ?? null);
                        echo "
                                </div>
                            ";
                    }
                    // line 131
                    echo "                        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 132
                echo "                    </div>

                ";
            } elseif ((            // line 134
($context["profile_section"] ?? null) == "wall")) {
                // line 135
                echo "                    <div class=\"magazine-profile__tabs\">
                        ";
                // line 136
                $this->loadTemplate("view_profile_menu.twig", "view_magazine.twig", 136)->display(twig_array_merge($context, ["template" => "magazine"]));
                // line 137
                echo "                    </div>

                    ";
                // line 139
                $this->loadTemplate("profile_top_magazine.twig", "view_magazine.twig", 139)->display($context);
                // line 140
                echo "
                    <div class=\"description\">
                        <div class=\"view-user\">
                            <div class=\"view-user__wall\">
                                ";
                // line 144
                if (($context["is_owner"] ?? null)) {
                    // line 145
                    echo "                                    ";
                    $context["place"] = "myprofile";
                    // line 146
                    echo "                                ";
                } else {
                    // line 147
                    echo "                                    ";
                    $context["place"] = "viewprofile";
                    // line 148
                    echo "                                ";
                }
                // line 149
                echo "                                ";
                $module =                 null;
                $helper =                 'wall_events';
                $name =                 'wall_block';
                $params = array(["place" =>                 // line 150
($context["place"] ?? null), "id_wall" =>                 // line 151
($context["user_id"] ?? null)]                ,                );
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
                // line 153
                echo "                            </div>
                        </div>
                    </div>
                ";
            }
            // line 157
            echo "
                ";
            // line 158
            $module =             null;
            $helper =             'users';
            $name =             'flippingProfiles';
            $params = array(["navigation" => ($context["magazine_navigation"] ?? null), "profile_id" => $this->getAttribute(($context["data"] ?? null), "id", [])]            ,            );
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
            // line 159
            echo "
                ";
            // line 160
            $module =             null;
            $helper =             'banners';
            $name =             'show_banner_place';
            $params = array("banner-980x90"            ,            );
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
            // line 161
            echo "                ";
            $module =             null;
            $helper =             'banners';
            $name =             'show_banner_place';
            $params = array("banner-185x75"            ,            );
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
            // line 162
            echo "                ";
            $module =             null;
            $helper =             'banners';
            $name =             'show_banner_place';
            $params = array("banner-185x155"            ,            );
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
            // line 163
            echo "                ";
            $module =             null;
            $helper =             'banners';
            $name =             'show_banner_place';
            $params = array("banner-320x250"            ,            );
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
            // line 164
            echo "                ";
            $module =             null;
            $helper =             'banners';
            $name =             'show_banner_place';
            $params = array("banner-320x75"            ,            );
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
            // line 165
            echo "
            </div>
            <div class=\"magazine-profile__pagecontrols magazine-profile__pagecontrols_topleft\">
                <a href=\"";
            // line 168
            echo ($context["magazine_close_url"] ?? null);
            echo "\"><span class=\"fa fa-times\"></span></a>
            </div>
            ";
            // line 170
            if (($context["is_owner"] ?? null)) {
                // line 171
                echo "                <div class=\"magazine-profile__pagecontrols magazine-profile__pagecontrols_topright\">
                    <a href=\"";
                // line 172
                echo ($context["site_url"] ?? null);
                echo "users/profile/";
                echo "view";
                echo "/all\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("tooltip_profile_edit_mode"                ,"users"                ,                );
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
                        <span class=\"fas fa-pencil-alt\"></span>
                    </a>
                </div>
            ";
            }
            // line 177
            echo "        </div>
    ";
        } elseif ((        // line 178
($context["profile_section"] ?? null) == "gallery")) {
            // line 179
            echo "        <div class=\"magazine-profile__gallery mag-mygallery\">
            <div class=\"mag-mygallery__header\">
                <div class=\"container\">
                    <div class=\"userblock\">
                        <a class=\"userblock__content\" href=\"";
            // line 183
            echo ($context["site_url"] ?? null);
            echo "users/view/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "/profile/all\">
                            <span class=\"fa fa-chevron-left\"></span>
                            <span class=\"userblock__photo\">";
            // line 185
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ($context["data"] ?? null), "size" => "small", "class" => "img-circle"]            ,            );
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
            // line 186
            echo $this->getAttribute(($context["data"] ?? null), "output_name", []);
            echo "
                        </a>
                    </div>
                </div>
            </div>

            <div class=\"mag-mygallery__media\">
                <div class=\"container\">
                    <div class=\"description\">
                        <div class=\"view-user\">
                            ";
            // line 196
            $module =             null;
            $helper =             'media';
            $name =             'media_block';
            $params = array(["param" =>             // line 197
($context["subsection"] ?? null), "page" => "1", "user_id" =>             // line 199
($context["user_id"] ?? null), "location_base_url" =>             // line 200
($context["location_base_url"] ?? null), "template" => "magazine"]            ,            );
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
            // line 203
            echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
        }
        // line 209
        echo "</div>

<div class=\"container\"><div class=\"row\">
";
        // line 212
        $this->loadTemplate("@app/footer.twig", "view_magazine.twig", 212)->display($context);
    }

    public function getTemplateName()
    {
        return "view_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1087 => 212,  1082 => 209,  1074 => 203,  1056 => 200,  1055 => 199,  1054 => 197,  1050 => 196,  1037 => 186,  1014 => 185,  1007 => 183,  1001 => 179,  999 => 178,  996 => 177,  965 => 172,  962 => 171,  960 => 170,  955 => 168,  950 => 165,  928 => 164,  906 => 163,  884 => 162,  862 => 161,  841 => 160,  838 => 159,  817 => 158,  814 => 157,  808 => 153,  790 => 151,  789 => 150,  784 => 149,  781 => 148,  778 => 147,  775 => 146,  772 => 145,  770 => 144,  764 => 140,  762 => 139,  758 => 137,  756 => 136,  753 => 135,  751 => 134,  747 => 132,  733 => 131,  727 => 128,  724 => 127,  721 => 126,  718 => 125,  715 => 124,  712 => 123,  695 => 122,  691 => 120,  687 => 118,  666 => 117,  663 => 116,  657 => 112,  635 => 111,  614 => 110,  607 => 105,  603 => 103,  582 => 102,  578 => 100,  557 => 99,  554 => 98,  548 => 94,  546 => 93,  541 => 90,  520 => 89,  516 => 87,  513 => 86,  491 => 85,  488 => 84,  485 => 83,  463 => 82,  461 => 81,  458 => 80,  436 => 79,  434 => 78,  431 => 77,  429 => 76,  425 => 74,  422 => 73,  411 => 72,  387 => 71,  337 => 70,  316 => 69,  312 => 68,  308 => 66,  306 => 65,  302 => 63,  300 => 62,  297 => 61,  295 => 60,  287 => 54,  266 => 53,  262 => 51,  256 => 49,  253 => 48,  210 => 47,  208 => 46,  192 => 33,  187 => 31,  161 => 27,  154 => 22,  133 => 21,  130 => 20,  126 => 18,  105 => 17,  102 => 16,  100 => 15,  96 => 13,  75 => 12,  71 => 11,  66 => 9,  63 => 8,  61 => 7,  57 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view_magazine.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/view_magazine.twig");
    }
}
