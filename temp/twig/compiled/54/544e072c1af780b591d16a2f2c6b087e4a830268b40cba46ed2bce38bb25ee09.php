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

/* edit_item_form.twig */
class __TwigTemplate_853b8d0876edf5150bcd08f2e135bb6d30c5c3d27e94b7eade6106622368ce41 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "edit_item_form.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_title\">
            <h2>
            ";
        // line 7
        if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
            // line 8
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_header_menu_item_change"            ,"menu"            ,            );
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
            echo "            ";
        } else {
            // line 10
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_header_menu_item_add"            ,"menu"            ,            );
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
            // line 11
            echo "            ";
        }
        // line 12
        echo "            </h2>
            <div class=\"clearfix\"></div>
        </div>
        <div class=\"x_content\">
            <form method=\"post\" name=\"save_form\" enctype=\"multipart/form-data\" data-parsley-validate class=\"form-horizontal form-label-left\">
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 19
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_menu_item_gid"        ,"menu"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                        <input type=\"text\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "gid", []));
        echo "\" name=\"gid\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
        // line 26
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_menu_item_link"        ,"menu"        ,        );
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
        echo ":</label>
                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                      <div class=\"input-group\">
                          <input type=\"checkbox\" class=\"flat\"  name=\"link_on\" id=\"link_on\" ";
        // line 29
        if (($this->getAttribute(($context["data"] ?? null), "link_out", []) || $this->getAttribute(($context["data"] ?? null), "link_in", []))) {
            echo "checked";
        }
        echo ">
                      </div>
                    </div>
                </div>
                <div id=\"link_out_block\" class=\"form-group ";
        // line 33
        if (( !$this->getAttribute(($context["data"] ?? null), "link_out", []) &&  !$this->getAttribute(($context["data"] ?? null), "link_in", []))) {
            echo " hide ";
        }
        echo "\">
                    <div class=\"col-md-6 col-sm-6 col-xs-12 col-sm-offset-3\">
                      <div class=\"input-group\">
                        <span class=\"input-group-btn\">
                          <input type=\"radio\" class=\"flat\" value=\"out\" name=\"link_type\" id=\"link_type_out\"
                            ";
        // line 38
        if ($this->getAttribute(($context["data"] ?? null), "link_out", [])) {
            echo "checked";
        }
        echo ">
                          <label class=\"btn row\">";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_external"        ,"menu"        ,        );
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
        echo "</label>
                        </span>
                        <input type=\"text\" class=\"form-control pull-left\" value=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "link_out", []));
        echo "\" name=\"link_out\" class=\"long_long\">
                      </div>
                    </div>
                </div>
                <div id=\"link_in_block\" class=\"form-group ";
        // line 45
        if (( !$this->getAttribute(($context["data"] ?? null), "link_out", []) &&  !$this->getAttribute(($context["data"] ?? null), "link_in", []))) {
            echo " hide ";
        }
        echo "\">
                  <div class=\"col-md-6 col-sm-6 col-xs-12 col-sm-offset-3\">
                    <div class=\"input-group\">
                      <span class=\"input-group-btn\">
                          <input type=\"radio\" class=\"flat\" value=\"in\" name=\"link_type\" id=\"link_type_in\"
                              ";
        // line 50
        if ($this->getAttribute(($context["data"] ?? null), "link_in", [])) {
            echo "checked";
        }
        echo ">
                          <label class=\"btn\">";
        // line 51
        echo ($context["site_url"] ?? null);
        echo "</label>
                      </span>
                      <input type=\"text\" class=\"form-control\" value=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "link_in", []));
        echo "\" class=\"middle\" name=\"link_in\">
                    </div>
                  </div>
                </div>
            ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
            // line 58
            echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 60
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_menu_item_value"            ,"menu"            ,            );
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
            echo " (";
            echo $this->getAttribute($context["item"], "name", []);
            echo "):</label>
                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                        <input type=\"text\" class=\"form-control\" name=\"langs[";
            // line 62
            echo $context["lang_id"];
            echo "]\"
                            value=\"";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["data"] ?? null), "langs", []), $context["lang_id"]));
            echo "\">
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "            ";
        if (($context["indicators"] ?? null)) {
            // line 68
            echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 70
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_indicator"            ,"menu"            ,            );
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
            if ($this->getAttribute(($context["item"] ?? null), "name", [])) {
                echo " (";
                echo $this->getAttribute(($context["item"] ?? null), "name", []);
                echo ")";
            }
            echo ":</label>
                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                        <select name=\"indicator_gid\" id=\"indicator\" class=\"form-control\">
                            <option value=\"0\">";
            // line 73
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_indicator"            ,"menu"            ,            );
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
            echo "</option>
                            ";
            // line 74
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["indicators"] ?? null));
            foreach ($context['_seq'] as $context["indicator_gid"] => $context["indicator"]) {
                // line 75
                echo "                                ";
                if ($this->getAttribute($context["indicator"], "name", [])) {
                    // line 76
                    echo "                                    <option value=\"";
                    echo $context["indicator_gid"];
                    echo "\" ";
                    if (($this->getAttribute(($context["data"] ?? null), "indicator_gid", []) == $context["indicator_gid"])) {
                        echo "selected=\"selected\"";
                    }
                    echo ">
                                        ";
                    // line 77
                    echo $this->getAttribute($context["indicator"], "name", []);
                    echo "
                                    </option>
                                ";
                }
                // line 80
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['indicator_gid'], $context['indicator'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "                        </select>
                    </div>
                </div>
            ";
        }
        // line 85
        echo "                <div class=\"ln_solid\"></div>
                <div class=\"form-group\">
                    <div class=\"col-sm-6 col-xs-12 col-sm-offset-3\">
                        ";
        // line 88
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"button"        ,        );
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
        $context['save_text'] = $result;
        // line 89
        echo "                        <input type=\"submit\" class=\"btn btn-success\" name=\"btn_save\" value=\"";
        echo ($context["save_text"] ?? null);
        echo "\">
                        <a href=\"";
        // line 90
        echo ($context["site_url"] ?? null);
        echo "admin/menu/items/";
        echo ($context["menu_id"] ?? null);
        echo "\" class=\"btn btn-default\">
                            ";
        // line 91
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
        // line 92
        echo "                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type=\"text/javascript\">
    \$(function(){
        \$('input[name=link_out]').click(function(){
            \$('#link_type_out').prop(\"checked\", true).parent().addClass(\"checked\");
            \$('#link_type_in').prop(\"checked\", false).parent().removeClass(\"checked\");
        });
        \$('input[name=link_in]').click(function(){
            \$('#link_type_out').prop(\"checked\", false).parent().removeClass(\"checked\");
            \$('#link_type_in').prop(\"checked\", true).parent().addClass(\"checked\");
        });
        \$('#link_type_out').next('label').click(function(){
            \$('input[name=link_out]').trigger('click').focus();
        });
        \$('#link_type_in').next('label').click(function(){
            \$('input[name=link_in]').trigger('click').focus();
        });

         \$('#link_on').click(function(){
            if (\$(this).prop(\"checked\")) {
                \$('#link_out_block').removeClass('hide');
                \$('#link_in_block').removeClass('hide');
            } else {
                \$('#link_out_block').addClass('hide');
                \$('#link_in_block').addClass('hide');
            }
          
        });
    });
</script>

";
        // line 130
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-ui.custom.min.js"        ,        );
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
        // line 131
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

";
        // line 133
        $this->loadTemplate("@app/footer.twig", "edit_item_form.twig", 133)->display($context);
    }

    public function getTemplateName()
    {
        return "edit_item_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  509 => 133,  502 => 131,  481 => 130,  441 => 92,  420 => 91,  414 => 90,  409 => 89,  388 => 88,  383 => 85,  377 => 81,  371 => 80,  365 => 77,  356 => 76,  353 => 75,  349 => 74,  326 => 73,  296 => 70,  292 => 68,  289 => 67,  279 => 63,  275 => 62,  249 => 60,  245 => 58,  241 => 57,  234 => 53,  229 => 51,  223 => 50,  213 => 45,  206 => 41,  182 => 39,  176 => 38,  166 => 33,  157 => 29,  132 => 26,  124 => 21,  100 => 19,  91 => 12,  88 => 11,  66 => 10,  63 => 9,  41 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_item_form.twig", "/home/mliadov/public_html/application/modules/menu/views/gentelella/edit_item_form.twig");
    }
}
