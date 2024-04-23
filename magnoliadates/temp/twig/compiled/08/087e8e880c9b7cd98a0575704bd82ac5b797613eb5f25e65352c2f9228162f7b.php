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

/* list_forms.twig */
class __TwigTemplate_19fdc2e57160c95420f157c448822d8e49348d4b09f6187a29729b1f8fbf469a extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_forms.twig", 1)->display($context);
        // line 2
        echo "<ul class=\"nav nav-tabs bar_tabs\">
    ";
        // line 3
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_fields_menu"        ,        );
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
        echo "</ul>

<div class=\"x_panel\">
    <div id=\"filter\" class=\"hide\">
      <div class=\"col-md-3 col-sm-3 col-xs-12\">
        <div class=\"form-group row\">
          <select id=\"section\" class=\"form-control\">
        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["types"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 12
            echo "            <option value=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" ";
            if ((($context["type"] ?? null) == $this->getAttribute($context["item"], "gid", []))) {
                echo "checked";
            }
            echo ">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</options>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "          </select>
        </div>
      </div>
    </div>

    <table id=\"data\" cellspacing=\"0\" cellpadding=\"0\" class=\"table table-striped jambo_table\">
        <thead>
            <tr>
                <th class=\"column-title\">";
        // line 22
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("form_name"        ,"field_editor"        ,        );
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
        echo "</th>
                <th class=\"column-title\">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
                ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["forms"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 28
            echo "                    <tr>
                        <td>";
            // line 29
            echo $this->getAttribute($context["item"], "name", []);
            echo "</td>
                        <td class=\"icons\">
                          <div class=\"btn-group\">
                            <a href=\"";
            // line 32
            echo ($context["site_url"] ?? null);
            echo "admin/field_editor/form_fields/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"
                               class=\"btn btn-primary\">";
            // line 33
            ob_start(function () { return ''; });
            // line 34
            echo "                                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_tableicon_edit_form_fields"            ,"field_editor"            ,""            ,"button"            ,            );
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
            // line 35
            echo "                            ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            echo "</a>
                            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                    aria-haspopup=\"true\" aria-expanded=\"false\">
                              <span class=\"caret\"></span>
                              <span class=\"sr-only\">Toggle Dropdown</span>
                            </button>
                            <ul class=\"dropdown-menu\">
                              <li>
                                <a href=\"";
            // line 43
            echo ($context["site_url"] ?? null);
            echo "admin/field_editor/form_fields/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                                    ";
            // line 44
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_tableicon_edit_form_fields"            ,"field_editor"            ,""            ,"button"            ,            );
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
            // line 45
            echo "                                </a>
                              </li>
                              <li>
                                <a href=\"";
            // line 48
            echo ($context["site_url"] ?? null);
            echo "admin/field_editor/form_edit/";
            echo ($context["type"] ?? null);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                                    ";
            // line 49
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_edit"            ,"start"            ,            );
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
            // line 50
            echo "                                </a>
                              </li>
                            ";
            // line 52
            if ( !$this->getAttribute($context["item"], "is_system", [])) {
                // line 53
                echo "                              <li>
                                <a href=\"";
                // line 54
                echo ($context["site_url"] ?? null);
                echo "admin/field_editor/form_delete/";
                echo ($context["type"] ?? null);
                echo "/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\"
                                   onclick=\"javascript: if (!confirm('";
                // line 55
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("note_delete_form"                ,"field_editor"                ,""                ,"js"                ,                );
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
                echo "')) return false;\">
                                      ";
                // line 56
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_delete"                ,"start"                ,                );
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
                // line 57
                echo "                                </a>
                              </li>
                            ";
            }
            // line 60
            echo "                            </ul>
                          </div>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "        </tbody>
    </table>
    ";
        // line 67
        $this->loadTemplate("@app/pagination.twig", "list_forms.twig", 67)->display($context);
        // line 68
        echo "</div>

<script>
  \$(function() {
    \$(document).off('change', '#section', function(e) {
      location.href = '";
        // line 73
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/forms/' + \$(this).val();
    });
  });
</script>

<!-- Datatables -->
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#data').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 84
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_all_column"        ,"start"        ,        );
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
        echo ":\",
                \"sEmptyTable\": \"";
        // line 85
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_forms"        ,"field_editor"        ,        );
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
            },
            \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': [1]
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
            \"dom\": 'T<\"clear\"><\"filter\">lfrtip',
        });
        \$(\"tfoot input\").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, \$(\"tfoot th\").index(\$(this).parent()));
        });
        \$(\"tfoot input\").each(function (i) {
            asInitVals[i] = this.value;
        });
        \$(\"tfoot input\").focus(function () {
            if (this.className == \"search_init\") {
                this.className = \"\";
                this.value = \"\";
            }
        });
        \$(\"tfoot input\").blur(function (i) {
            if (this.value == \"\") {
                this.className = \"search_init\";
                this.value = asInitVals[\$(\"tfoot input\").index(this)];
            }
        });
        var filter = \$(\"#filter\");
        \$('#data_wrapper').find('.filter').html(filter.html());
        filter.remove();
    });
</script>


";
        // line 124
        $this->loadTemplate("@app/footer.twig", "list_forms.twig", 124)->display($context);
    }

    public function getTemplateName()
    {
        return "list_forms.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  424 => 124,  363 => 85,  340 => 84,  326 => 73,  319 => 68,  317 => 67,  313 => 65,  303 => 60,  298 => 57,  277 => 56,  254 => 55,  246 => 54,  243 => 53,  241 => 52,  237 => 50,  216 => 49,  208 => 48,  203 => 45,  182 => 44,  176 => 43,  164 => 35,  142 => 34,  140 => 33,  134 => 32,  128 => 29,  125 => 28,  121 => 27,  94 => 22,  84 => 14,  69 => 12,  65 => 11,  56 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_forms.twig", "/home/mliadov/public_html/application/modules/field_editor/views/gentelella/list_forms.twig");
    }
}
