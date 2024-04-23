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

/* helper_wink_link.twig */
class __TwigTemplate_21b21b0fc2240c0d73da4e273154bf7aa2961e75ddab679d761c68186403b3f5 extends \Twig\Template
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
        echo "<span class=\"user-menu-item\">
    <a id=\"btn-wink-";
        // line 2
        echo ($context["wink_button_rand"] ?? null);
        echo "\"
       class=\"btn-wink";
        // line 3
        if (($context["wink_back"] ?? null)) {
            echo "-back";
        }
        echo " link-r-margin ";
        if (($context["is_pending"] ?? null)) {
            echo "link-disabled";
        }
        echo "\"
       data-user-id=\"";
        // line 4
        echo ($context["partner_id"] ?? null);
        echo "\" data-is-pending=\"";
        echo ($context["is_pending"] ?? null);
        echo "\"
       data-is-new=\"";
        // line 5
        echo ($context["is_new"] ?? null);
        echo "\" title=\"";
        ob_start(function () { return ''; });
        // line 6
        echo "       ";
        if (($context["wink_back"] ?? null)) {
            // line 7
            echo "           ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wink_back"            ,"winks"            ,            );
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
            // line 8
            echo "       ";
        } else {
            // line 9
            echo "           ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wink"            ,"winks"            ,            );
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
            // line 10
            echo "       ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "\" href=\"javascript:void(0);\">

           ";
        // line 12
        if (($context["wink_back"] ?? null)) {
            // line 13
            echo "               ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wink_back"            ,"winks"            ,            );
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
            echo "           ";
        } else {
            // line 15
            echo "               ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wink"            ,"winks"            ,            );
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
            // line 16
            echo "           ";
        }
        // line 17
        echo "       </a>
    </span>
    <script>
        \$(function () {
        loadScripts(
                    [\"";
        // line 22
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("winks"        ,"winks.js"        ,"path"        ,        );
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
                        winksObj = new winks({
                        siteUrl: site_url,
                        titleWink: \"";
        // line 26
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("wink"        ,"winks"        ,""        ,"js"        ,        );
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
                        titleWinkBack: \"";
        // line 27
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("wink_back"        ,"winks"        ,""        ,"js"        ,        );
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
                        errIsPending: \"";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_is_pending"        ,"winks"        ,""        ,"js"        ,        );
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
                        errIsOnList: \"";
        // line 29
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_is_on_list"        ,"winks"        ,""        ,"js"        ,        );
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
                        succIgnored: \"";
        // line 30
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("msg_ignored"        ,"winks"        ,""        ,"js"        ,        );
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
                        succWinked: \"";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("msg_winked"        ,"winks"        ,""        ,"js"        ,        );
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
                        succResponded: \"";
        // line 32
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("msg_responded"        ,"winks"        ,""        ,"js"        ,        );
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
                        wink_button_rand: '";
        // line 33
        echo ($context["wink_button_rand"] ?? null);
        echo "'
                        });
                    },
                    'winksObj',
                    {async: false}
                    );
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "helper_wink_link.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  360 => 33,  337 => 32,  314 => 31,  291 => 30,  268 => 29,  245 => 28,  222 => 27,  199 => 26,  173 => 22,  166 => 17,  163 => 16,  141 => 15,  138 => 14,  116 => 13,  114 => 12,  107 => 10,  85 => 9,  82 => 8,  60 => 7,  57 => 6,  53 => 5,  47 => 4,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_wink_link.twig", "/home/mliadov/public_html/application/modules/winks/views/flatty/helper_wink_link.twig");
    }
}
