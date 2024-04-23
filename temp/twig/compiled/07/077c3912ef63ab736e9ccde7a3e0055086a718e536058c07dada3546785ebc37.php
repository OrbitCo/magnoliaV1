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

/* dialog.twig */
class __TwigTemplate_ecc179e2616ff1fc88809e73293d19845262ed764d0234ab0e870dffeca96080 extends \Twig\Template
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
        echo "<div class=\"chatbox-dialog__header\">
    <div class=\"chatbox-dialog__h-user\">
        ";
        // line 3
        if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
            // line 4
            echo "        <a href=\"";
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["contact"] ?? null)            ,            );
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
            echo "\"><img class=\"chatbox-dialog__h-user-image\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["contact"] ?? null), "media", []), "user_logo", []), "thumbs", []), "small", []);
            echo "\" /></a>
        ";
        } else {
            // line 6
            echo "            <span class=\"chatbox-messages__sitelogo\">
            ";
            // line 7
            if (($context["is_mini_logo"] ?? null)) {
                // line 8
                echo "                <img src=\"";
                echo ($context["site_root"] ?? null);
                echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "path", []);
                echo "?";
                echo twig_random($this->env);
                echo "\" border=\"0\"
                alt=\"";
                // line 9
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seo_tags_default';
                $params = array("header_text"                ,                );
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
                width=\"";
                // line 10
                echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "width", []);
                echo "\"
                height=\"";
                // line 11
                echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "height", []);
                echo "\" id=\"logo\">
            ";
            } else {
                // line 13
                echo "                ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'logo';
                $params = array(["type" => "user", "settings" => ($context["logo_settings"] ?? null)]                ,                );
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
                // line 14
                echo "            ";
            }
            // line 15
            echo "            </span>
        ";
        }
        // line 17
        echo "        <span class=\"chatbox-dialog__h-user-name\">
            ";
        // line 18
        if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
            // line 19
            echo "            <a href=\"";
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["contact"] ?? null)            ,            );
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
            echo "\"> ";
            echo $this->getAttribute(($context["contact"] ?? null), "output_name", []);
            echo "</a>
            ";
        } else {
            // line 21
            echo "                ♡ ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("site_notification"            ,"chatbox"            ,            );
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
            echo "            ";
        }
        // line 23
        echo "        </span>
        <span class=\"chatbox-dialog__h-user-status\">
            ";
        // line 25
        if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
            // line 26
            echo "            ";
            if ($this->getAttribute(($context["contact"] ?? null), "online_status", [])) {
                // line 27
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("status_online_1"                ,"users"                ,                );
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
                // line 28
                echo "            ";
            } else {
                // line 29
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_user_last_active"                ,"chatbox"                ,                );
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
                echo "&nbsp;
                ";
                // line 30
                $module =                 null;
                $helper =                 'date_format';
                $name =                 'tpl_date_format';
                $params = array($this->getAttribute(($context["contact"] ?? null), "date_last_activity", [])                ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                ,                );
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
                // line 31
                echo "            ";
            }
            // line 32
            echo "            ";
        }
        // line 33
        echo "        </span>

        ";
        // line 35
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("twilio_chat"        ,        );
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
        // line 36
        echo "        ";
        if (($this->getAttribute(($context["is_module_installed"] ?? null), "twilio_chat", []) && ($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", [])))) {
            // line 37
            echo "            <span user-id=\"";
            echo $this->getAttribute(($context["contact"] ?? null), "id", []);
            echo "\" data-action=\"set-user_menu_actions\">";
            $module =             null;
            $helper =             'twilio_chat';
            $name =             'videoButton';
            $params = array(["id_user" => $this->getAttribute(($context["contact"] ?? null), "id", []), "view_type" => "icon"]            ,            );
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
        // line 39
        echo "
    </div>
    <div class=\"chatbox-dialog__h-close\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"";
        // line 41
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_close_dialog"        ,"chatbox"        ,        );
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
        echo "\" id=\"chb_close_dialog\">
        <i class=\"fas fa-arrow-left\"></i>
    </div>
    <div class=\"chatbox-mobile-msg-counter\"></div>
</div>
<div class=\"chatbox-dialog__messages\" gallery=\"contact_";
        // line 46
        echo $this->getAttribute(($context["contact"] ?? null), "id", []);
        echo "\">
    <div class=\"chatbox-dialog__messages-empty\" ";
        // line 47
        if ( !twig_test_empty(($context["messages"] ?? null))) {
            echo "style=\"display:none;\"";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("empty_messages"        ,"chatbox"        ,        );
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
    <ul>
        ";
        // line 49
        $this->loadTemplate("messages.twig", "dialog.twig", 49)->display($context);
        // line 50
        echo "    </ul>
</div>
<div class=\"chatbox-dialog__footer\">
    <div class=\"chatbox-counter\"><span class=\"max-char-input\" data-max=\"";
        // line 53
        echo ($context["message_max_chars"] ?? null);
        echo "\">";
        echo ($context["message_max_chars"] ?? null);
        echo "</span></div>
    <form id=\"chatbox_message_form\" onsubmit=\"javascript: return false;\" method=\"post\" enctype=\"multipart/form-data\" name=\"chatbox_message_form\">
        <input type=\"hidden\" name=\"id\" value=\"0\" />
        <input type=\"hidden\" name=\"contact_id\" value=\"";
        // line 56
        echo $this->getAttribute(($context["contact"] ?? null), "id", []);
        echo "\" />
        <div class=\"chatbox-dialog__footer-msgbox\">
            <textarea class=\"form-control\" name=\"message\" placeholder=\"";
        // line 58
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("placeholder_enter_message"        ,"chatbox"        ,        );
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
        echo "\" id=\"chb_message\" data-emojiable=\"true\" data-emoji-input=\"unicode\"></textarea>
        </div>
        <div class=\"chatbox-attaches-block col-xs-12 col-md-10\" id=\"chb_attaches\">
            <div id=\"dnd_upload\" class=\"drag\">
                <div id=\"chatbox_attachbox\" class=\"drag-area\">
                    <div class=\"drag\">
                        <p>";
        // line 64
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_drag_files"        ,"chatbox"        ,        );
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
        echo "</p>
                    </div>
                </div>
            </div>
            <div>
                <div class=\"upload-btn\">
                    <span data-role=\"filebutton\">
                        <s>";
        // line 71
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_choose_file"        ,"start"        ,        );
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
        echo "</s>
                        <input type=\"file\" name=\"attach\" id=\"chatbox_attach\" accept=\"image/*\" multiple />
                    </span>
                    ";
        // line 74
        if (($this->getAttribute(($context["attach_settings"] ?? null), "max_size", []) > 0)) {
            echo "&nbsp;(";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("max"            ,"start"            ,            );
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
            $module =             null;
            $helper =             'utils';
            $name =             'bytesFormat';
            $params = array($this->getAttribute(($context["attach_settings"] ?? null), "max_size", [])            ,            );
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
            echo ")";
        }
        // line 75
        echo "                </div>
                &nbsp;<span id=\"attach-input-error\"></span>
                <div id=\"attach-input-warning\"></div>
            </div>
        </div>
       <div class=\"chatbox-dialog__footer-actions hide\">
           ";
        // line 81
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("chats"        ,        );
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
        // line 82
        echo "           ";
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "chats", [])) {
            // line 83
            echo "               <span id=\"go_to_chat_btn\">
               ";
            // line 84
            $module =             null;
            $helper =             'chats';
            $name =             'helperBtnChat';
            $params = array(["user_id" => $this->getAttribute(($context["contact"] ?? null), "id", []), "view_type" => "button", "class" => "btn btn-primary btn-rounded"]            ,            );
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
            // line 85
            echo "               </span>
           ";
        }
        // line 87
        echo "            <button type=\"button\" data-toggle=\"tooltip\" data-placement=\"top\" disabled class=\"btn btn-primary\" id=\"chb_send_msg_btn\" title=\"";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_send_message"        ,"chatbox"        ,        );
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
        echo "\"><i class=\"fas fa-paper-plane\"></i></button>
            <button class=\"btn btn-primary\" onclick=\"\$('#chb_attaches').stop().slideToggle(); return false;\">";
        // line 88
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_show_attach_form"        ,"chatbox"        ,        );
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
        echo "</button>
        </div>
    </form>
</div>

<script type=\"text/javascript\">
    \$(function(){
        let allowed_mimes = ";
        // line 95
        echo twig_jsonencode_filter($this->getAttribute(($context["attach_settings"] ?? null), "allowed_mimes", []));
        echo ";
        \$('#chb_send_msg_btn').tooltip({ trigger: \"hover\" });

        let i;
        if (\$('.chatbox').length) {
            \$('.chatbox-dialog__footer-actions #go_to_chat_btn').appendTo(\$('.chatbox-dialog__footer .chatbox-dialog__footer-msgbox'));
            \$('.chatbox-dialog__footer-actions #chb_send_msg_btn').appendTo(\$('.chatbox-dialog__footer .chatbox-dialog__footer-msgbox'));
            const checkText = function () {
                let text_length = \$('.emoji-wysiwyg-editor').text().length;
                let left_char = \$('.max-char-input').data('max') - text_length;

                if (left_char < 0) {
                    left_char = 0;
                }
                \$('.max-char-input').text(left_char);

                if (text_length == 0) {
                    text_length = \$('#chb_message').val().length;
                }

                if (text_length > \$('.max-char-input').data('max')) {
                    \$('#chb_send_msg_btn').prop('disabled', true);
                } else {
                    let html = \$('.chatbox .emoji-wysiwyg-editor').html();

                    if (html) {
                        if (html.length) {
                            \$('#chb_send_msg_btn').prop('disabled', false);
                        } else {
                            if (!\$('.chatbox .filebar img').length) {
                                \$('#chb_send_msg_btn').prop('disabled', true);
                            }
                        }
                    } else {
                        if (\$('#chb_message').val().length) {
                            \$('#chb_send_msg_btn').prop('disabled', false);
                        } else {
                            if (!\$('.chatbox .filebar img').length) {
                                \$('#chb_send_msg_btn').prop('disabled', true);
                            }
                        }
                    }
                }
            };

            i = 0;
            const find_editor = setInterval(function () {
                i++;

                if (\$('.chatbox .emoji-wysiwyg-editor').length || i == 8) {
                    \$('#chatbox_message_form .emoji-wysiwyg-editor').after(\$('.chatbox-counter'));
                    \$('.chatbox-counter').show();
                    \$('.chatbox .emoji-wysiwyg-editor').on('change keydown keyup paste', function () {
                        checkText();
                    });

                    \$('#chb_message').on('change keydown keyup paste', function () {
                        checkText();
                    });

                    clearInterval(find_editor);
                }
            }, 500);

            const check_files = setInterval(function () {
                if (\$('.chatbox').length && \$('.chatbox .emoji-wysiwyg-editor').length) {
                    if (!\$('.chatbox .emoji-wysiwyg-editor').html() ||
                        \$('.chatbox .emoji-wysiwyg-editor').html() == '<br>' ||
                        \$('.chatbox .emoji-wysiwyg-editor').html() == '<div><br></div>') {
                        \$('.chatbox .emoji-wysiwyg-editor').css('height', 'auto')
                    }

                    if (!\$('.chatbox .filebar img').length &&
                        (!\$('.chatbox .emoji-wysiwyg-editor').html().length ||
                            \$('.chatbox .emoji-wysiwyg-editor').html() == '<br>' ||
                            \$('.chatbox .emoji-wysiwyg-editor').html() == '<div><br></div>')) {
                        \$('#chb_send_msg_btn').prop('disabled', true);
                    } else {
                        let text_length = \$('#chb_message').val().length;
                        if (text_length < \$('.max-char-input').data('max')) {
                            \$('#chb_send_msg_btn').prop('disabled', false);
                        }

                    }
                }
            }, 200);
        }

        loadScripts(
            [
                \"";
        // line 185
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"uploader.js"        ,"path"        ,        );
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
            function() {
                chatboxUpload = new uploader({
                    siteUrl: site_url,
                    uploadUrl: 'chatbox/post_upload',
                    zoneId: 'chatbox_attachbox',
                    fileId: 'chatbox_attach',
                    formId: 'chatbox_message_form',
                    sendType: 'file',
                    sendId: 'chb_send_msg_btn',
                    filebarId: 'filebar',
                    messageId: 'attach-input-error',
                    warningId: 'attach-input-warning',
                    maxFileSize: '";
        // line 199
        echo $this->getAttribute(($context["attach_settings"] ?? null), "max_size", []);
        echo "',
                    mimeType: allowed_mimes,
                    allowEmptyFile: true,
                    isChat: true,
                    cbOnSend: function (resp) {
                        \$('#chb_send_msg_btn').tooltip('hide');
                        if (typeof window.chatbox.properties.emojiPicker !== 'undefined') {
                            var editor = \$('.emoji-wysiwyg-editor').clone();
                            \$('.emoji-wysiwyg-editor').html('');
                            \$('.max-char-input').text(\$('.max-char-input').data('max'));
                            editor.find('img').each(function(){
                                var alt = \$(this).attr('alt');
                                \$(this).replaceWith(alt);
                            });

                            let message = editor.html();
                            //let message = editor.text();

                            if (!message) {
                                message = \$('#chb_message').val();
                            }

                            message = window.chatbox.getMessageText(message);

                            \$('#' + window.chatbox.properties.sendMsgId).val(message);
                        }
                        if (resp == true) {
                            chatboxUpload.sendNoFileApi();
                        } else {
                            chatboxUpload.send();
                        }
                        \$('#chb_send_msg_btn').prop('disabled', true);
                        \$('#chb_send_msg_btn').blur();
                        \$('[data-toggle=\"tooltip\"]').tooltip();
                    },
                    cbOnComplete: function(resp) {
                        window.chatbox.properties.uploaded = true;
                        setTimeout(function () {
                            \$('.chatbox-dialog__messages').animate({ scrollTop: \$('.chatbox-dialog__messages ul').height() }, \"fast\");
                        }, 1000);
                        if (resp.message_id) {
                            \$('#chatbox_message_form').find('input[name=\"id\"]').val(resp.message_id);
                        }
                        \$('#chb_send_msg_btn').prop('disabled', true);
                        \$('#chb_send_msg_btn').blur();
                    },
                    cbOnQueueComplete: function(resp) {
                        var complete_id = \$('#chatbox_message_form').find('input[name=\"id\"]').val();
                        \$('#chatbox_message_form').find('input[name=\"id\"]').val('0');
                        if (!window.chatbox.properties.uploaded) {
                            window.chatbox.sendMessage();
                        } else {
                            \$('#' + window.chatbox.properties.sendMsgId).val('');
                            \$('#' + window.chatbox.properties.sendMsgId).css('height', 'auto');
                            if(typeof window.chatbox.properties.emojiPicker !== 'undefined') {
                                window.chatbox.properties.emojiPicker.clearTextarea('.emoji-wysiwyg-editor');
                            }
                            \$('#' + window.chatbox.properties.sendMsgId).parent().find('.emoji-wysiwyg-editor').css('height', 'auto');

                            window.chatbox.getMessages();

                            \$('#chb_attaches').stop().slideUp();

                        }

                        setTimeout(function () {
                            \$('.chatbox-dialog__messages').animate({ scrollTop: \$('.chatbox-dialog__messages ul').height() }, \"fast\");
                        }, 1000);

                        \$.ajax({
                            url: site_url + 'chatbox/post_upload_complete',
                            type: 'POST',
                            data: {
                                complete_id: complete_id
                            },
                            dataType: 'json',
                            cache: false,
                            success: function (resp) {
                                setTimeout(function () {
                                    \$('.chatbox-dialog__messages').animate({ scrollTop: \$('.chatbox-dialog__messages ul').height() }, \"fast\");
                                }, 1000);
                            }
                        });
                        window.chatbox.properties.uploaded = false;
                        \$('#chb_send_msg_btn').prop('disabled', true);
                        \$('#chb_send_msg_btn').blur();
                        return false;
                    },
                    cbOnError: function(resp) {
                        if (resp.errors.length){
                            error_object.show_error_block(resp.errors, 'error');
                        }
                    },
                    cbOnProcessError: function(resp) {
                        error_object.show_error_block(resp, 'error');
                    },
                    createThumb: true,
                    thumbWidth: 60,
                    thumbHeight: 60,
                    thumbCrop: true,
                    thumbJpeg: false,
                    thumbBg: 'transparent',
                    fileListInZone: true,
                    filebarHeight: 200,
                    jqueryFormPluginUrl: \"";
        // line 303
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery.form.min.js"        ,"path"        ,        );
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
                });
            },
            [],
            {async: true}
        );
    });

</script>
";
    }

    public function getTemplateName()
    {
        return "dialog.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  894 => 303,  787 => 199,  751 => 185,  658 => 95,  629 => 88,  605 => 87,  601 => 85,  580 => 84,  577 => 83,  574 => 82,  553 => 81,  545 => 75,  499 => 74,  474 => 71,  445 => 64,  417 => 58,  412 => 56,  404 => 53,  399 => 50,  397 => 49,  369 => 47,  365 => 46,  338 => 41,  334 => 39,  307 => 37,  304 => 36,  283 => 35,  279 => 33,  276 => 32,  273 => 31,  252 => 30,  228 => 29,  225 => 28,  203 => 27,  200 => 26,  198 => 25,  194 => 23,  191 => 22,  169 => 21,  142 => 19,  140 => 18,  137 => 17,  133 => 15,  130 => 14,  108 => 13,  103 => 11,  99 => 10,  76 => 9,  68 => 8,  66 => 7,  63 => 6,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "dialog.twig", "/home/mliadov/public_html/application/modules/chatbox/views/flatty/dialog.twig");
    }
}
