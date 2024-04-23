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

/* user_profile_magazine.twig */
class __TwigTemplate_981975eb279f0c048f18d1fdf5f4c06927cba830ff59c00fc73b6186a3d3528a extends \Twig\Template
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
        echo "
";
        // line 2
        ob_start(function () { return ''; });
        $module =         null;
        $helper =         'access_permissions';
        $name =         'isMoreThanOneActiveGroup';
        $params = array(        );
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
        $context["is_one_group"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 3
        $module =         null;
        $helper =         'access_permissions';
        $name =         'getUserGroupInfo';
        $params = array(["id_user" => ($context["user_id"] ?? null), "is_default_excluded" => 1]        ,        );
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
        $context['user_group'] = $result;
        // line 4
        echo "
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '6897243193627173');
fbq('track', 'PageView');
</script>
<noscript><img height=\"1\" width=\"1\" style=\"display:none\"
src=\"https://www.facebook.com/tr?id=6897243193627173&ev=PageView&noscript=1\"
/></noscript>
<!-- End Meta Pixel Code -->


<!-- Top.Mail.Ru counter -->
<script type=\"text/javascript\">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: \"3385436\", type: \"pageView\", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement(\"script\"); ts.type = \"text/javascript\"; ts.async = true; ts.id = id;
  ts.src = \"https://top-fwz1.mail.ru/js/code.js\";
  var f = function () {var s = d.getElementsByTagName(\"script\")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == \"[object Opera]\") { d.addEventListener(\"DOMContentLoaded\", f, false); } else { f(); }
})(document, window, \"tmr-code\");
</script>
<noscript><div><img src=\"https://top-fwz1.mail.ru/counter?id=3385436;js=na\" style=\"position:absolute;left:-9999px;\" alt=\"Top.Mail.Ru\" /></div></noscript>
<!-- /Top.Mail.Ru counter -->


<div class=\"magazine-profile\">
    ";
        // line 41
        if ((((($context["action"] ?? null) == "") || (($context["action"] ?? null) == "view")) || (($context["action"] ?? null) == "wall"))) {
            // line 42
            echo "        <div class=\"magazine-profile__media mag-portrait\">
            <div id=\"user_photo_bg\" class=\"magazine-profile__avabg\" style=\"background: url(";
            // line 43
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "thumbs", []), "middle", []);
            echo ") no-repeat center / cover;\"></div>
            <div class=\"magazine-profile__ava\">
                <div id=\"user_photo_block\">
                    ";
            // line 46
            if (($context["is_owner"] ?? null)) {
                // line 47
                echo "                        <div class=\"magazine-profile__ava-action_block\" data-block=\"ava-action_block\">
                            ";
                // line 48
                if (twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "is_default", []))) {
                    // line 49
                    echo "                                <span data-action=\"remove-avatar\" class=\"btn btn-primary-inverted hide\" title=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_icon_delete"                    ,"users"                    ,                    );
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
                                    <i class=\"fa fa-times\"></i>
                                </span>
                            ";
                }
                // line 53
                echo "                            <span data-change=\"user-avatar\" class=\"btn btn-primary hide\">
                                ";
                // line 54
                if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "is_default", [])) {
                    // line 55
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_upload_photo"                    ,"media"                    ,                    );
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
                    // line 56
                    echo "                                ";
                } else {
                    // line 57
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_change_photo"                    ,"media"                    ,                    );
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
                    // line 58
                    echo "                                ";
                }
                // line 59
                echo "                            </span>
                        </div>
                    ";
            }
            // line 62
            echo "                    <a id=\"user_photo\">
                        ";
            // line 63
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
            // line 64
            echo "                    </a>
                </div>
                ";
            // line 66
            if (($context["is_owner"] ?? null)) {
                // line 67
                echo "                    <div class=\"change-photo-button photo-action-js owner-change-photo\">
                        ";
                // line 68
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
                // line 69
                echo "                    </div>
                ";
            }
            // line 71
            echo "                <div class=\"view-photo-button photo-action-js\">
                    ";
            // line 72
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
            // line 73
            echo "                </div>
                
                <!--Affiliate-->
                <script type=\"text/javascript\">
!function () {
document.addEventListener(\"DOMContentLoaded\", function () {
let clickId = getCookie(\"skro-click-id\");
if (clickId === null || clickId === undefined || clickId === 'undefined') {

return false;
}
let xhr = new XMLHttpRequest;
xhr.open(\"GET\", \"https://skrotrack.com/postback?clickId=\" + clickId);
console.log('SKRO AFFILIATE');
console.log(clickId);
xhr.send();
});

function getCookie(e) {
let t = (\"; \" + document.cookie).split(\"; \" + e + \"=\");
if (2 === t.length) return t.pop().split(\";\").shift()
}
}();
</script>

                <script>
                    \$(function () {
                        loadScripts(
                                [\"";
            // line 101
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
            // line 105
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo " ,
                                        saveAfterSelect: false,
                                        haveAvatar: '";
            // line 107
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
            // line 120
            if (($this->getAttribute(($context["data"] ?? null), "online_status", []) == 0)) {
                // line 121
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
                // line 122
                echo "                ";
            } else {
                // line 123
                echo "                    ";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "statuses", []), "online_status_lang", []);
                echo "
                ";
            }
            // line 125
            echo "            </div>
            <div class=\"magazine-profile__recentmedia\">
                ";
            // line 127
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
            // line 128
            echo "            </div>
        </div>

        <div class=\"magazine-profile__text\">
            <div class=\"magazine-profile__content\">
                ";
            // line 133
            if (((($context["action"] ?? null) == "") || (($context["action"] ?? null) == "view"))) {
                // line 134
                echo "                    <div class=\"magazine-profile__tabs\">
                        ";
                // line 135
                $this->loadTemplate("profile_menu.twig", "user_profile_magazine.twig", 135)->display(twig_array_merge($context, ["template" => "magazine"]));
                // line 136
                echo "                    </div>

                    ";
                // line 138
                $this->loadTemplate("profile_top_magazine.twig", "user_profile_magazine.twig", 138)->display(twig_array_merge($context, ["is_owner" => ($context["is_owner"] ?? null)]));
                // line 139
                echo "
                    <div class=\"magazine-profile__base\">
                        ";
                // line 141
                echo $this->getAttribute(($context["data"] ?? null), "user_type_str", []);
                echo "
                        ";
                // line 142
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
                // line 143
                echo "                        ";
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "horoscope", [])) {
                    // line 144
                    echo "                          ";
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
                    // line 145
                    echo "                          ";
                    if ( !twig_test_empty(($context["sign_horoscope"] ?? null))) {
                        // line 146
                        echo "                            , ";
                        echo ($context["sign_horoscope"] ?? null);
                        echo "
                          ";
                    }
                    // line 148
                    echo "                        ";
                }
                // line 149
                echo "                        ";
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "perfect_match", [])) {
                    echo ", <span>";
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
                    // line 150
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
                    // line 151
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
                    // line 152
                    echo "                        ";
                }
                // line 153
                echo "                    </div>

                    <div class=\"magazine-profile__services mag-services\">
                        ";
                // line 156
                if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                    // line 157
                    echo "                            <div class=\"mag-services__item";
                    if ((twig_length_filter($this->env, $this->getAttribute(($context["user_group"] ?? null), "left_str", [])) > 0)) {
                        echo " mag-services__item_active";
                    }
                    echo "\" data-action=\"access-permissions-page\">
                                <div class=\"mag-services__icon\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
                    // line 158
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("user_in_default_group_tooltip"                    ,"access_permissions"                    ,                    );
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
                                    <img class=\"mag-services__color\" src=\"";
                    // line 159
                    echo ($context["base_url"] ?? null);
                    echo ($context["img_folder"] ?? null);
                    echo "icons/ic-rocket.png\" alt=\"\">
                                    <img class=\"mag-services__gray\" src=\"";
                    // line 160
                    echo ($context["base_url"] ?? null);
                    echo ($context["img_folder"] ?? null);
                    echo "icons/ic-rocket-gray.png\" alt=\"\">
                                    <div class=\"mag-services__plus\"><i class=\"fa fa-plus\"></i></div>
                                    <div class=\"mag-services__counter\">";
                    // line 162
                    echo $this->getAttribute(($context["user_group"] ?? null), "left_str", []);
                    if (($this->getAttribute(($context["user_group"] ?? null), "left_str", []) > 0)) {
                        echo " ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("date_diff_left"                        ,"services"                        ,                        );
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
                    }
                    echo "</div>
                                </div>
                                <div class=\"mag-services__title\">
                                    ";
                    // line 165
                    echo $this->getAttribute($this->getAttribute(($context["user_group"] ?? null), "data", []), "current_name", []);
                    echo "
                                </div>
                            </div>
                        ";
                }
                // line 169
                echo "
                        <div class=\"mag-services__item";
                // line 170
                if ($this->getAttribute(($context["data"] ?? null), "account", [])) {
                    echo " mag-services__item_active";
                }
                echo "\" data-action=\"set-payment-system\">
                            <div class=\"mag-services__icon\">
                                <img class=\"mag-services__color\" src=\"";
                // line 172
                echo ($context["base_url"] ?? null);
                echo ($context["img_folder"] ?? null);
                echo "icons/ic-account.png\" alt=\"\">
                                <img class=\"mag-services__gray\" src=\"";
                // line 173
                echo ($context["base_url"] ?? null);
                echo ($context["img_folder"] ?? null);
                echo "icons/ic-account-gray.png\" alt=\"\">
                                <div class=\"mag-services__plus\"><i class=\"fa fa-plus\"></i></div>
                                <div class=\"mag-services__counter on-account-amount\">";
                // line 175
                $module =                 null;
                $helper =                 'users';
                $name =                 'onUserAccount';
                $params = array(["output_type" => "long"]                ,                );
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
                            </div>
                            <div class=\"mag-services__title\">
                                ";
                // line 178
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("add_funds"                ,"users_payments"                ,                );
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
                // line 179
                echo "                            </div>
                        </div>
                        ";
                // line 181
                $module =                 null;
                $helper =                 'services';
                $name =                 'servicesBuyList';
                $params = array(["tpl" => "magazine"]                ,                );
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
                // line 182
                echo "                    </div>

                    <div class=\"magazine-profile__params\">
                        <div class=\"description\">
                            <div class=\"view-user\">
                                <div class=\"view-user__descr\">
                                    <script type=\"text/javascript\">
                                        \$(function () {
                                            loadScripts(
                                                [
                                                    \"";
                // line 192
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array(""                ,"available_view.js"                ,"path"                ,                );
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
                                                function(){
                                                        users_profile_available_view = new available_view({
                                                                siteUrl: site_url
                                                        });
                                                },
                                                'users_profile_available_view',
                                                {async: false}
                                            );
                                        });
                                        \$(function () {
                                            loadScripts(
                                                [
                                                    \"";
                // line 206
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array("access_permissions"                ,"AccessPermissions.js"                ,"path"                ,                );
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
                                                function(){
                                                    user_access_permissions = new AccessPermissions({
                                                        siteUrl: site_url
                                                    });
                                                },
                                                ['user_access_permissions'],
                                                {async: false}
                                            );
                                        });
                                    </script>

                                    ";
                // line 219
                $this->loadTemplate("view_my_profile.twig", "user_profile_magazine.twig", 219)->display(twig_array_merge($context, ["is_owner" => true]));
                // line 220
                echo "                                </div>
                            </div>
                        </div>
                        <div class=\"magazine-profile__gifts\">
                            ";
                // line 224
                $module =                 null;
                $helper =                 'virtual_gifts';
                $name =                 'user_gifts_block';
                $params = array(["id_wall" => $this->getAttribute(($context["data"] ?? null), "id", []), "is_mine" => "true", "template" => "magazine", "is_limit_cnt" => false]                ,                );
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
                // line 225
                echo "                        </div>
                        <div id=\"bonuses\" class=\"clearfix mb10\">
                            ";
                // line 227
                $module =                 null;
                $helper =                 'bonuses';
                $name =                 'bonuses_form';
                $params = array(                );
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
                // line 228
                echo "                        </div>
                    </div>
                ";
            } elseif ((            // line 230
($context["action"] ?? null) == "wall")) {
                // line 231
                echo "                    <div class=\"magazine-profile__tabs\">
                        ";
                // line 232
                $this->loadTemplate("profile_menu.twig", "user_profile_magazine.twig", 232)->display(twig_array_merge($context, ["template" => "magazine"]));
                // line 233
                echo "                    </div>

                    ";
                // line 235
                $this->loadTemplate("profile_top_magazine.twig", "user_profile_magazine.twig", 235)->display($context);
                // line 236
                echo "
                    <div class=\"description\">
                        <div class=\"view-user\">
                            <div class=\"view-user__wall\">
                                ";
                // line 240
                $module =                 null;
                $helper =                 'wall_events';
                $name =                 'wall_block';
                $params = array(["place" => "myprofile", "id_wall" => ($context["user_id"] ?? null)]                ,                );
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
                // line 241
                echo "                            </div>
                        </div>
                    </div>

                    <div id=\"bonuses\" class=\"clearfix mb10\">
                        ";
                // line 246
                $module =                 null;
                $helper =                 'bonuses';
                $name =                 'bonuses_form';
                $params = array(                );
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
                // line 247
                echo "                    </div>
                ";
            }
            // line 249
            echo "            </div>
            <div class=\"magazine-profile__pagecontrols magazine-profile__pagecontrols_topleft\">
                <a href=\"";
            // line 251
            echo ($context["magazine_close_url"] ?? null);
            echo "\"><span class=\"fa fa-times\"></span></a>
            </div>
            <div class=\"magazine-profile__pagecontrols magazine-profile__pagecontrols_topright\">
                <a href=\"";
            // line 254
            echo ($context["site_url"] ?? null);
            echo "users/view/";
            echo ($context["user_id"] ?? null);
            echo "/";
            if ((($context["action"] ?? null) == "wall")) {
                echo "wall";
            } else {
                echo "profile";
            }
            echo "/all\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("tooltip_profile_view_mode"            ,"users"            ,            );
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
                    <span class=\"far fa-eye\"></span>
                </a>
                ";
            // line 257
            if ((($context["action"] ?? null) == "wall")) {
                // line 258
                echo "                    <a id=\"wall_permissions_link\" href=\"javascript: void(0);\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("header_wall_settings"                ,"wall_events"                ,                );
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
                echo "\" onclick=\"ajax_permissions_form(site_url + 'wall_events/ajax_user_permissions/');\">
                        <i class=\"fa fa-cog hover wall-settings\"></i>
                    </a>
                ";
            }
            // line 262
            echo "            </div>
        </div>
    ";
        } elseif ((        // line 264
($context["action"] ?? null) == "gallery")) {
            // line 265
            echo "        <div class=\"magazine-profile__gallery mag-mygallery\">
            <div class=\"mag-mygallery__header\">
                <div class=\"container\">
                    <div class=\"userblock\">
                        <a class=\"userblock__content\" href=\"";
            // line 269
            echo ($context["site_url"] ?? null);
            echo "users/profile/view/all\">
                            <span class=\"fa fa-chevron-left\"></span>
                            <span class=\"userblock__photo\">";
            // line 271
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
            // line 272
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
            // line 282
            $module =             null;
            $helper =             'media';
            $name =             'media_block';
            $params = array(["param" =>             // line 283
($context["subsection"] ?? null), "page" => "1", "location_base_url" =>             // line 285
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
            // line 288
            echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            \$(function(){
                ";
            // line 296
            echo "                \$('.pjaxcontainer-inner').css('background-color',
                    \$('.magazine-profile').css('background-color'));
            });
        </script>
    ";
        }
        // line 301
        echo "</div>

";
        // line 303
        if ((((($this->getAttribute(($context["data"] ?? null), "approved", []) && $this->getAttribute(($context["data"] ?? null), "confirm", [])) &&  !$this->getAttribute(($context["data"] ?? null), "is_activated", [])) &&  !$this->getAttribute($this->getAttribute(        // line 304
($context["data"] ?? null), "available_activation", []), "status", [])) && $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "services_status", []), "user_activate_in_search", []), "service", []), "status", []))) {
            // line 305
            echo "    <div id=\"modalIncomplete\" class=\"hide\">
        <div class=\"load_content_controller\">
            <h1>
                ";
            // line 308
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_services"            ,"users"            ,            );
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
            // line 309
            echo "            </h1>
            <div class=\"inside\">
                <div data-block=\"activate-profile\">
                    ";
            // line 312
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_activate_profile"            ,"users"            ,            );
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
            // line 313
            echo "                    <input data-action=\"profile_available\" type=\"button\" class=\"btn btn-primary btn-large btn-block mt20\" data-service=\"user_activate_in_search\" value=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_activate_profile"            ,"users"            ,            );
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
            echo "\" />
                </div>
            </div>
        </div>
    </div>
    <script>
        \$(function() {
            var modal_incomplete_window = new loadingContent({
                loadBlockWidth: '500px',
                loadBlockLeftType: 'center',
                loadBlockTopType: 'center',
                closeBtnClass: 'w'
            });
            modal_incomplete_window.show_load_block(\$('#modalIncomplete').html());
        });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "user_profile_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1221 => 313,  1200 => 312,  1195 => 309,  1174 => 308,  1169 => 305,  1167 => 304,  1166 => 303,  1162 => 301,  1155 => 296,  1146 => 288,  1128 => 285,  1127 => 283,  1123 => 282,  1110 => 272,  1087 => 271,  1082 => 269,  1076 => 265,  1074 => 264,  1070 => 262,  1043 => 258,  1041 => 257,  1006 => 254,  1000 => 251,  996 => 249,  992 => 247,  971 => 246,  964 => 241,  943 => 240,  937 => 236,  935 => 235,  931 => 233,  929 => 232,  926 => 231,  924 => 230,  920 => 228,  899 => 227,  895 => 225,  874 => 224,  868 => 220,  866 => 219,  831 => 206,  795 => 192,  783 => 182,  762 => 181,  758 => 179,  737 => 178,  712 => 175,  706 => 173,  701 => 172,  694 => 170,  691 => 169,  684 => 165,  655 => 162,  649 => 160,  644 => 159,  621 => 158,  614 => 157,  612 => 156,  607 => 153,  604 => 152,  593 => 151,  569 => 150,  545 => 149,  542 => 148,  536 => 146,  533 => 145,  511 => 144,  508 => 143,  487 => 142,  483 => 141,  479 => 139,  477 => 138,  473 => 136,  471 => 135,  468 => 134,  466 => 133,  459 => 128,  438 => 127,  434 => 125,  428 => 123,  425 => 122,  382 => 121,  380 => 120,  364 => 107,  359 => 105,  333 => 101,  303 => 73,  282 => 72,  279 => 71,  275 => 69,  254 => 68,  251 => 67,  249 => 66,  245 => 64,  224 => 63,  221 => 62,  216 => 59,  213 => 58,  191 => 57,  188 => 56,  166 => 55,  164 => 54,  161 => 53,  134 => 49,  132 => 48,  129 => 47,  127 => 46,  121 => 43,  118 => 42,  116 => 41,  77 => 4,  56 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_profile_magazine.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\user_profile_magazine.twig");
    }
}
