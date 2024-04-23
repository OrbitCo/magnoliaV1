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

/* @app/header_lite.twig */
class __TwigTemplate_27d07fc600bd888ae4da62aaf923fc62b946a8eff822bb9df17c344f46ce6528 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'bodyclass' => [$this, 'block_bodyclass'],
            'container' => [$this, 'block_container'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ( !($context["is_pjax"] ?? null)) {
            // line 2
            echo "<!DOCTYPE html>
<html dir=\"";
            // line 3
            echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
            echo "\" lang=\"";
            echo $this->getAttribute(($context["_LANG"] ?? null), "code", []);
            echo "\">
<head>
    
<!-- Google tag (gtag.js) -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-33LW1GP9FR\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-33LW1GP9FR');
</script>


<script type=\"text/javascript\">
!function () {
const config = {
customDomain: \"magnoliadates.com\",
cookieName: \"skro-click-id\",
clickIdParameterName: \"skroClickId\",
httpProtocol: \"https\",
cookieExpTime: 30 * 24 * 60 * 60 * 1000
};
let skroCookie = getCookie(config.cookieName);
let URLParams = new URLSearchParams(window.location.search);
let skroClickId = URLParams.get(config.clickIdParameterName);
if (skroClickId !== null) {
  
if (skroCookie === null || skroCookie === undefined || skroCookie === 'undefined') {

setCookie(config, skroClickId);
}
return false;
}

function setCookie(config, clickId) {
let expirationTime = config.cookieExpTime, date = new Date(), dateTimeNow = date.getTime();
date.setTime(dateTimeNow + expirationTime);
document.cookie = config.cookieName + \"=\" + clickId + \"; expires=\" + date.toUTCString() + \"; path=/; domain=.\" + location.hostname.replace(/^www\\./i, \"\");
}

function getCookie(name) {
let value = \"; \" + document.cookie;
let parts = value.split(\"; \" + name + \"=\");
if (parts.length === 2) return parts.pop().split(\";\").shift();
}
}();
</script>
<noscript><div><img src=\"https://mc.yandex.ru/watch/93390561\" style=\"position:absolute; left:-9999px;\" alt=\"\" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
  
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
  <meta http-equiv=\"expires\" content=\"0\">
  <meta http-equiv=\"pragma\" content=\"no-cache\">
  <meta name=\"revisit-after\" content=\"3 days\">
  ";
            // line 61
            $module =             null;
            $helper =             'seo';
            $name =             'seo_tags';
            $params = array("robots"            ,            );
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
            // line 62
            echo "  ";
            $module =             null;
            $helper =             'start';
            $name =             'favicon';
            $params = array(["type" => "user"]            ,            );
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
            // line 63
            echo "  ";
        }
        // line 64
        echo "
  ";
        // line 65
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("title"        ,        );
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
        // line 66
        echo "  ";
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("description|keyword|canonical|og_title|og_type|og_url|og_image|og_site_name|og_description"        ,        );
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
        echo "
  <script>
    var site_rtl_settings = '";
        // line 69
        echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
        echo "'
    var is_pjax = parseInt('";
        // line 70
        echo ($context["is_pjax"] ?? null);
        echo "')
    var js_events = ";
        // line 71
        echo twig_jsonencode_filter(($context["js_events"] ?? null));
        echo ";
    var id_user = ";
        // line 72
        if ($this->getAttribute(($context["user_session_data"] ?? null), "user_id", [])) {
            echo $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []);
        } else {
            echo "0";
        }
        echo ";
    var auth_type = ";
        // line 73
        if ($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", [])) {
            echo "'";
            echo $this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []);
            echo "'
    ";
        } else {
            // line 74
            echo "'guest'";
        }
        echo ";
    var is_webpack = true
  </script>

  ";
        // line 78
        if ( !($context["is_pjax"] ?? null)) {
            // line 79
            echo "  <link rel=\"stylesheet\" href=\"";
            echo ($context["site_root"] ?? null);
            echo "application/views/flatty/css/bootstrap-";
            echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
            echo ".css\">
  ";
            // line 80
            $module =             null;
            $helper =             'theme';
            $name =             'include_css';
            $params = array("style"            ,"screen"            ,            );
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
            // line 81
            echo "  ";
            $module =             null;
            $helper =             'theme';
            $name =             'css';
            $params = array(($context["load_type"] ?? null)            ,            );
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
            // line 82
            echo "
  <script>
    var site_url = '";
            // line 84
            echo ($context["site_url"] ?? null);
            echo "'
    var base_url = '";
            // line 85
            echo ($context["base_url"] ?? null);
            echo "'
    var site_root = '";
            // line 86
            echo ($context["site_root"] ?? null);
            echo "'
    var theme = '";
            // line 87
            echo ($context["theme"] ?? null);
            echo "'
    var img_folder = '";
            // line 88
            echo ($context["img_folder"] ?? null);
            echo "'
    var site_error_position = 'center'
    var use_pjax = parseInt('";
            // line 90
            echo ($context["use_pjax"] ?? null);
            echo "')
    var pjax_container = '#pjaxcontainer'
  </script>

  ";
            // line 94
            $module =             null;
            $helper =             'themes';
            $name =             'load';
            $params = array(["name" => "main", "ext" => "js"]            ,            );
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
            // line 95
            echo "
  ";
            // line 96
            $module =             null;
            $helper =             'seo_advanced';
            $name =             'seo_traker';
            $params = array("top"            ,            );
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
            // line 97
            echo "  ";
            $module =             null;
            $helper =             'start';
            $name =             'analytics';
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
            // line 98
            echo "</head>
<body class=\"";
            // line 99
            $this->displayBlock('bodyclass', $context, $blocks);
            echo "\">
    
    

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-NHWF4RKJ\"
height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



  ";
            // line 110
            $this->loadTemplate("@app/preloader.twig", "@app/header_lite.twig", 110)->display($context);
            // line 111
            echo "  ";
            $module =             null;
            $helper =             'start';
            $name =             'demo_panel';
            $params = array(["type" => "user", "place" => "top"]            ,            );
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
            echo "  <div id=\"pjaxcontainer\" class=\"pjaxcontainer\">
  ";
            // line 113
            $this->displayBlock('container', $context, $blocks);
            // line 114
            echo "  ";
        }
    }

    // line 99
    public function block_bodyclass($context, array $blocks = [])
    {
    }

    // line 113
    public function block_container($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "@app/header_lite.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  438 => 113,  433 => 99,  428 => 114,  426 => 113,  423 => 112,  401 => 111,  399 => 110,  385 => 99,  382 => 98,  360 => 97,  339 => 96,  336 => 95,  315 => 94,  308 => 90,  303 => 88,  299 => 87,  295 => 86,  291 => 85,  287 => 84,  283 => 82,  261 => 81,  240 => 80,  233 => 79,  231 => 78,  223 => 74,  216 => 73,  208 => 72,  204 => 71,  200 => 70,  196 => 69,  192 => 67,  170 => 66,  149 => 65,  146 => 64,  143 => 63,  121 => 62,  100 => 61,  37 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@app/header_lite.twig", "/home/mliadov/public_html/application/views/flatty/header_lite.twig");
    }
}
