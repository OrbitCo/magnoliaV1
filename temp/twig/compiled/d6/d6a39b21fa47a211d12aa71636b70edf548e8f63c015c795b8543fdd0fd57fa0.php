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

/* subscription_form.twig */
class __TwigTemplate_71c67bf76e50b48e6db8d4098613e3bf4ca7e966e81c08d2e3b24af110b18e27 extends \Twig\Template
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
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_header_create_group"        ,"access_permissions"        ,        );
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
        // line 4
        echo "    </div>
    <div>
        <form action=\"";
        // line 6
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"save_form\" name=\"save_form\" data-parsley-validate class=\"form-horizontal form-label-left\">
            <input type=\"hidden\" name=\"data[id]\" value=\"";
        // line 7
        echo $this->getAttribute(($context["subscription"] ?? null), "id", []);
        echo "\"><!-- ID -->
            ";
        // line 8
        if ($this->getAttribute(($context["subscription"] ?? null), "gid", [])) {
            // line 9
            echo "                <div class=\"form-group\"><!-- GUID -->
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 11
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_gid"            ,"access_permissions"            ,            );
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
            echo ":&nbsp;
                    </label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"text\" name=\"data[gid]\" value=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute(($context["subscription"] ?? null), "gid", []));
            echo "\" class=\"form-control\" readonly>
                    </div>
                </div>
            ";
        }
        // line 18
        echo "            <div class=\"form-group\"><!-- Title -->
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
        // line 20
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_title"        ,"access_permissions"        ,        );
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
        echo ": &nbsp;*
                </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    ";
        // line 23
        $context["name"] = ("name_" . ($context["current_lang_id"] ?? null));
        // line 24
        echo "                    <input type=\"text\" name=\"data[name_";
        echo ($context["current_lang_id"] ?? null);
        echo "]\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["subscription"] ?? null), ($context["name"] ?? null), [], "array"));
        echo "\" class=\"form-control\"
                           lang-editor=\"value\" lang-editor-type=\"data-name\" lang-editor-lid=\"";
        // line 25
        echo ($context["lang_id"] ?? null);
        echo "\" />                        
                </div>
                <div class=\"accordion col-md-9 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-3\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                    <div class=\"panel\">
                        <a class=\"panel-heading\" role=\"tab\" id=\"headingOne\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\" aria-expanded=\"false\" aria-controls=\"collapseOne\">
                            <h4 class=\"panel-title\">";
        // line 30
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("others_languages"        ,"services"        ,        );
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
        echo "</h4>
                        </a>
                        <div id=\"collapseOne\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">
                            <div class=\"panel-body\">
                                ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["langs"] ?? null));
        foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
            // line 35
            echo "                                    ";
            if (($context["lang_id"] != ($context["current_lang_id"] ?? null))) {
                // line 36
                echo "                                        <div class=\"form-group\">
                                            <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                // line 37
                echo $this->getAttribute($context["lang_item"], "name", []);
                echo ":</label>
                                            <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                <input type=\"text\" name=\"data[name_";
                // line 39
                echo $context["lang_id"];
                echo "]\"
                                                       value=\"";
                // line 40
                echo twig_escape_filter($this->env, $this->getAttribute(($context["subscription"] ?? null), ("name_" . $context["lang_id"])));
                echo "\"
                                                       lang-editor=\"value\" lang-editor-type=\"data-name\" lang-editor-lid=\"";
                // line 41
                echo $context["lang_id"];
                echo "\"
                                                       class=\"form-control\">
                                            </div>
                                        </div>
                                    ";
            }
            // line 46
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"form-group\"> <!-- Description -->
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
        // line 54
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_description"        ,"access_permissions"        ,        );
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
                    ";
        // line 57
        $context["description"] = $this->getAttribute("description_", "current_lang_id", []);
        // line 58
        echo "                    <textarea name=\"data[description_";
        echo ($context["current_lang_id"] ?? null);
        echo "]\" class=\"form-control\" lang-editor=\"value\"
                              lang-editor-type=\"data-description\" lang-editor-lid=\"";
        // line 59
        echo ($context["current_lang_id"] ?? null);
        echo "\"
                              >";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute(($context["subscription"] ?? null), ("description_" . ($context["current_lang_id"] ?? null))));
        echo "</textarea>
                </div>
                <div class=\"accordion col-md-9 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-3\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                    <div class=\"panel\">
                        <a class=\"panel-heading\" role=\"tab\" id=\"headingTwo\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\" aria-expanded=\"false\" aria-controls=\"collapseTwo\">
                            <h4 class=\"panel-title\">";
        // line 65
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("others_languages"        ,"services"        ,        );
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
        echo "</h4>
                        </a>
                        <div id=\"collapseTwo\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingTwo\">
                            <div class=\"panel-body\">
                                ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["langs"] ?? null));
        foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
            // line 70
            echo "                                    ";
            if (($context["lang_id"] != ($context["current_lang_id"] ?? null))) {
                // line 71
                echo "                                        <div class=\"form-group\">
                                            <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                // line 72
                echo $this->getAttribute($context["item"], "name", []);
                echo "</label>
                                            <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                <textarea name=\"data[description_";
                // line 74
                echo $context["lang_id"];
                echo "]\" class=\"form-control\" lang-editor=\"value\"
                                                          lang-editor-type=\"data-description\" lang-editor-lid=\"";
                // line 75
                echo $context["lang_id"];
                echo "\"
                                                          >";
                // line 76
                echo twig_escape_filter($this->env, $this->getAttribute(($context["subscription"] ?? null), ("description_" . $context["lang_id"])));
                echo "</textarea>
                                            </div>
                                        </div>
                                    ";
            }
            // line 80
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
        // line 86
        if (($this->getAttribute(($context["subscription"] ?? null), "gid", []) == "trial")) {
            echo "  
                <div class=\"form-group\"><!-- GUID -->
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 89
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_trial_period"            ,"access_permissions"            ,            );
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
            echo ":&nbsp;
                    </label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <font class=\"text-capitalize\">";
            // line 92
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_days"            ,"access_permissions"            ,            );
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
            echo "</font>:&nbsp;<input type=\"number\" name=\"data[trial_days]\" value=\"";
            echo $this->getAttribute($this->getAttribute(($context["subscription"] ?? null), "trial_period", []), "trial_days", []);
            echo "\" class=\"form-control\" min=\"0\">
                        <font class=\"text-capitalize\">";
            // line 93
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_hours"            ,"access_permissions"            ,            );
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
            echo "</font>:&nbsp;<input type=\"number\" name=\"data[trial_hours]\" value=\"";
            echo $this->getAttribute($this->getAttribute(($context["subscription"] ?? null), "trial_period", []), "trial_hours", []);
            echo "\" class=\"form-control\" min=\"0\" max=\"24\">
                    </div>
                </div>
            ";
        }
        // line 97
        echo "            ";
        if (($this->getAttribute(($context["subscription"] ?? null), "is_default", []) != 1)) {
            echo "                
                <div class=\"form-group\"> <!-- STATUS -->
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 100
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_status"            ,"access_permissions"            ,            );
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
                            <input type=\"checkbox\" name=\"data[is_active]\" ";
            // line 104
            if ($this->getAttribute(($context["subscription"] ?? null), "is_active", [])) {
                echo "checked";
            }
            echo " class=\"flat\">
                        </div>
                    </div>
                </div>
            ";
        }
        // line 109
        echo "        </form>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "subscription_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  463 => 109,  453 => 104,  427 => 100,  420 => 97,  392 => 93,  367 => 92,  342 => 89,  336 => 86,  329 => 81,  323 => 80,  316 => 76,  312 => 75,  308 => 74,  303 => 72,  300 => 71,  297 => 70,  293 => 69,  267 => 65,  259 => 60,  255 => 59,  250 => 58,  248 => 57,  223 => 54,  214 => 47,  208 => 46,  200 => 41,  196 => 40,  192 => 39,  187 => 37,  184 => 36,  181 => 35,  177 => 34,  151 => 30,  143 => 25,  136 => 24,  134 => 23,  109 => 20,  105 => 18,  98 => 14,  73 => 11,  69 => 9,  67 => 8,  63 => 7,  59 => 6,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "subscription_form.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\access_permissions\\views\\gentelella\\subscription_form.twig");
    }
}
