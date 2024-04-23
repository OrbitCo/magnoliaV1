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

/* helper_download_page.twig */
class __TwigTemplate_494bd20eb86d8938d0f52e53bd4b6fc525cbdd770aabb8bccd21b04bf599b155 extends \Twig\Template
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
        echo "<div>
    <h1>";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_download_data"        ,"user_information"        ,        );
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
    <div class=\"form-group\">";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_download_data_description"        ,"user_information"        ,        );
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
    <div class=\"form-group\">
        <button class=\"btn ";
        // line 5
        if ((($this->getAttribute(($context["data"] ?? null), "status", []) == "during") || ($this->getAttribute(($context["data"] ?? null), "status", []) == "pending"))) {
            echo "btn-default";
        } else {
            echo "btn-primary";
        }
        echo "\" 
            ";
        // line 6
        if (($this->getAttribute(($context["data"] ?? null), "status", []) == "ready")) {
            // line 7
            echo "               data-action=\"ready-archive\" data-status=\"";
            echo $this->getAttribute(($context["data"] ?? null), "status", []);
            echo "\">
                    <i class=\"fa fa-download\" aria-hidden=\"true\"></i> ";
            // line 8
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_download"            ,"user_information"            ,            );
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
            echo "                </button>
                <button data-action=\"delete-archive\" class=\"btn btn-default \">
                    ";
            // line 11
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_delete_archive"            ,"user_information"            ,            );
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
            // line 12
            echo "                </button>
            ";
        } elseif ((($this->getAttribute(        // line 13
($context["data"] ?? null), "status", []) == "during") || ($this->getAttribute(($context["data"] ?? null), "status", []) == "pending"))) {
            // line 14
            echo "                data-action=\"during-archive\" data-status=\"";
            echo $this->getAttribute(($context["data"] ?? null), "status", []);
            echo "\" disabled>
                <i class=\"fa fa-spinner\" aria-hidden=\"true\"></i> ";
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_gathering"            ,"user_information"            ,            );
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
            ";
        } else {
            // line 17
            echo "                    data-action=\"create-archive\" data-status=\"";
            echo $this->getAttribute(($context["data"] ?? null), "status", []);
            echo "\">
                ";
            // line 18
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_create"            ,"user_information"            ,            );
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
            ";
        }
        // line 20
        echo "    </div>
    <div class=\"form-group\">
        <div  id=\"ui-description_block\">
            ";
        // line 23
        if ((($this->getAttribute(($context["data"] ?? null), "status", []) == "during") || ($this->getAttribute(($context["data"] ?? null), "status", []) == "pending"))) {
            // line 24
            echo "                <div class=\"well\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_download_data_description_prepared"            ,"user_information"            ,            );
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
            ";
        }
        // line 26
        echo "        </div>
    </div>
    <div class=\"form-group\">";
        // line 28
        $module =         null;
        $helper =         'user_information';
        $name =         'modulesList';
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
        echo "</div>
</div>
<script>
    \$(function () {
        loadScripts(
                \"";
        // line 33
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("user_information"        ,"UserInformation.js"        ,"path"        ,        );
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
                    user_information = new UserInformation({
                        siteUrl: site_url,
                        lang:{
                            btnCreate: '";
        // line 38
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_create"        ,"user_information"        ,        );
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
                            btnDuring: '";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_gathering"        ,"user_information"        ,        );
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
                            btnReady: '";
        // line 40
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_download"        ,"user_information"        ,        );
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
                            descriptionPrepared: '";
        // line 41
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_download_data_description_prepared"        ,"user_information"        ,        );
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
        echo "'
                        }
                    });
                },
                ['user_information'],
                {async: false}
        );
    });
</script>";
    }

    public function getTemplateName()
    {
        return "helper_download_page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  363 => 41,  340 => 40,  317 => 39,  294 => 38,  267 => 33,  240 => 28,  236 => 26,  211 => 24,  209 => 23,  204 => 20,  180 => 18,  175 => 17,  151 => 15,  146 => 14,  144 => 13,  141 => 12,  120 => 11,  116 => 9,  95 => 8,  90 => 7,  88 => 6,  80 => 5,  56 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_download_page.twig", "/home/mliadov/public_html/application/modules/user_information/views/flatty/helper_download_page.twig");
    }
}
