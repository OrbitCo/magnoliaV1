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

/* access_settings.twig */
class __TwigTemplate_c692262af0d17cdbeac2f364b0d680ae25144e071e426f2d7987ce63b4e7da9b extends \Twig\Template
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
        echo "<div class=\"load_content_controller\">
    <div class=\"x_title h4\">
        ";
        // line 3
        if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "method", [])) {
            // line 4
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(((("field_permission_" . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", [])) . "_") . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "method", []))            ,"access_permissions"            ,            );
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
            // line 5
            echo "        ";
        } else {
            // line 6
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(("field_permission_" . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", []))            ,"access_permissions"            ,            );
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
            // line 7
            echo "        ";
        }
        // line 8
        echo "    </div>
    <div id=\"access-settings-form\">
        <form action=\"";
        // line 10
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"save_form\" name=\"permissions_form\" data-parsley-validate class=\"form-horizontal form-label-left\">
            <input type=\"hidden\" name=\"send\" value=\"1\">
            <input type=\"hidden\" name=\"module[access]\" value=\"";
        // line 12
        echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "access", []);
        echo "\">
            <input type=\"hidden\" name=\"module[module_gid]\" value=\"";
        // line 13
        echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", []);
        echo "\">
            ";
        // line 14
        if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "user_type", [])) {
            // line 15
            echo "                <input type=\"hidden\" name=\"permissions[user_type]\" value=\"";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "user_type", []);
            echo "\">
            ";
        }
        // line 17
        echo "            ";
        if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "method", [])) {
            // line 18
            echo "                <input type=\"hidden\" name=\"module[method]\" value=\"";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "method", []);
            echo "\">
                ";
            // line 19
            $context["field_action"] = ((("field_action_" . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", [])) . "_") . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "method", []));
            // line 20
            echo "                ";
            $context["permission"] = (($this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", []) . "_") . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "method", []));
            // line 21
            echo "            ";
        } else {
            // line 22
            echo "                 ";
            $context["field_action"] = ("field_action_" . $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", []));
            // line 23
            echo "                 ";
            $context["permission"] = $this->getAttribute($this->getAttribute(($context["data"] ?? null), "permissions", []), "module_gid", []);
            // line 24
            echo "            ";
        }
        // line 25
        echo "            <input type=\"hidden\" name=\"module[permission]\" value=\"";
        echo ($context["permission"] ?? null);
        echo "\">
            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 27
            echo "                <div class=\"subscription-block\">
                    <div class=\"h5\">";
            // line 28
            echo $this->getAttribute($context["group"], "current_name", []);
            echo "</div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                ";
            // line 31
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(($context["field_action"] ?? null)            ,"access_permissions"            ,            );
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
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <input type=\"hidden\" value=\"0\" name=\"permissions[list][";
            // line 34
            echo ($context["permission"] ?? null);
            echo "][";
            echo $this->getAttribute($context["group"], "gid", []);
            echo "][status]\">
                                <div class=\"checkbox\">
                                    <input type=\"checkbox\" value=\"1\" name=\"permissions[list][";
            // line 36
            echo ($context["permission"] ?? null);
            echo "][";
            echo $this->getAttribute($context["group"], "gid", []);
            echo "][status]\" ";
            if (($this->getAttribute($this->getAttribute(($context["access"] ?? null), $this->getAttribute($context["group"], "gid", []), [], "array"), "status", []) != "empty")) {
                echo "checked";
            }
            echo " class=\"flat\">
                               </div>
                            </div>
                        </div>
                        ";
            // line 40
            $module =             null;
            $helper =             'access_permissions';
            $name =             'isCount';
            $params = array(["data" => $this->getAttribute(($context["data"] ?? null), "permissions", [], "array"), "permissions" => $this->getAttribute($this->getAttribute(($context["access"] ?? null), $this->getAttribute(($context["group"] ?? null), "gid", []), [], "array"), "permissions", [], "array"), "group_gid" => $this->getAttribute(($context["group"] ?? null), "gid", [])]            ,            );
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
            $context['count'] = $result;
            // line 41
            echo "                        ";
            if (($context["count"] ?? null)) {
                // line 42
                echo "                            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["count"] ?? null));
                foreach ($context['_seq'] as $context["type"] => $context["value"]) {
                    // line 43
                    echo "                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                        ";
                    // line 45
                    echo $this->getAttribute($context["value"], "name", []);
                    echo ":
                                    </label>
                                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                        <input type=\"text\" name=\"permissions[list][";
                    // line 48
                    echo ($context["permission"] ?? null);
                    echo "][";
                    echo $this->getAttribute($context["group"], "gid", []);
                    echo "][count][";
                    echo $context["type"];
                    echo "]\" value=\"";
                    echo $this->getAttribute($context["value"], "count", []);
                    echo "\" class=\"form-control\" ";
                    if (($this->getAttribute($context["value"], "count", []) == 0)) {
                        echo "placeholder=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("field_unlimited"                        ,"access_permissions"                        ,                        );
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
                        echo "\"";
                    }
                    echo ">
                                        <div class=\"clarification\">";
                    // line 49
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_ziro"                    ,"access_permissions"                    ,                    );
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
                                </div>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['type'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "                        ";
            }
            // line 54
            echo "                </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 56
            echo "                <div class=\"subscription-block\">
                    <div class=\"h5\">";
            // line 57
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_users_guest"            ,"access_permissions"            ,            );
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
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                ";
            // line 60
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(($context["field_action"] ?? null)            ,"access_permissions"            ,            );
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
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <div class=\"checkbox\">
                                    <input type=\"hidden\" value=\"0\" name=\"permissions[list][";
            // line 64
            echo ($context["permission"] ?? null);
            echo "][guest][status]\">
                                    <input type=\"checkbox\" value=\"1\" name=\"permissions[list][";
            // line 65
            echo ($context["permission"] ?? null);
            echo "][guest][status]\" ";
            if (($this->getAttribute($this->getAttribute(($context["access"] ?? null), "guest", []), "status", []) != "empty")) {
                echo "checked";
            }
            echo " class=\"flat\">
                                </div>
                            </div>
                        </div>
                        ";
            // line 69
            $module =             null;
            $helper =             'access_permissions';
            $name =             'isCount';
            $params = array(["permissions" => $this->getAttribute($this->getAttribute(($context["access"] ?? null), "guest", []), "permissions", [], "array"), "data" => $this->getAttribute(($context["data"] ?? null), "permissions", [], "array"), "group_gid" => "guest"]            ,            );
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
            $context['count'] = $result;
            // line 70
            echo "                        ";
            if (($context["count"] ?? null)) {
                // line 71
                echo "                            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["count"] ?? null));
                foreach ($context['_seq'] as $context["type"] => $context["value"]) {
                    // line 72
                    echo "                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                        ";
                    // line 74
                    echo $this->getAttribute($context["value"], "name", []);
                    echo ":
                                    </label>
                                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                        <input type=\"text\" name=\"permissions[list][";
                    // line 77
                    echo ($context["permission"] ?? null);
                    echo "][guest][count][";
                    echo $context["type"];
                    echo "]\" value=\"";
                    echo $this->getAttribute($context["value"], "count", []);
                    echo "\" class=\"form-control\" ";
                    if (($this->getAttribute($context["value"], "count", []) == 0)) {
                        echo "placeholder=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("field_unlimited"                        ,"access_permissions"                        ,                        );
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
                        echo "\"";
                    }
                    echo ">
                                        <div class=\"clarification\">";
                    // line 78
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_ziro"                    ,"access_permissions"                    ,                    );
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
                                </div>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['type'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 82
                echo "                        ";
            }
            // line 83
            echo "                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        echo "        </form>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "access_settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  492 => 85,  485 => 83,  482 => 82,  453 => 78,  420 => 77,  414 => 74,  410 => 72,  405 => 71,  402 => 70,  381 => 69,  370 => 65,  366 => 64,  340 => 60,  315 => 57,  312 => 56,  306 => 54,  303 => 53,  274 => 49,  239 => 48,  233 => 45,  229 => 43,  224 => 42,  221 => 41,  200 => 40,  187 => 36,  180 => 34,  155 => 31,  149 => 28,  146 => 27,  141 => 26,  136 => 25,  133 => 24,  130 => 23,  127 => 22,  124 => 21,  121 => 20,  119 => 19,  114 => 18,  111 => 17,  105 => 15,  103 => 14,  99 => 13,  95 => 12,  90 => 10,  86 => 8,  83 => 7,  61 => 6,  58 => 5,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "access_settings.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\access_permissions\\views\\gentelella\\access_settings.twig");
    }
}
