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

/* sections_view_mode.twig */
class __TwigTemplate_9a5eaa322c81b2d721e35730d4ba9c87ba5699fd558f6a5e89ef4725c6be4cb1 extends \Twig\Template
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
        echo "<div id=\"actions\" class=\"hide\">
    <div class=\"btn-group\">
        <a href=\"";
        // line 3
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/section_edit/";
        echo ($context["type"] ?? null);
        echo "/\" class=\"btn btn-primary\">
            ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_section"        ,"field_editor"        ,        );
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
        echo "        </a>
        <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
            aria-haspopup=\"true\" aria-expanded=\"false\">
            <span class=\"caret\"></span>
            <span class=\"sr-only\">Toggle Dropdown</span>
        </button>
        <ul class=\"dropdown-menu\">
            <li>
                <a href=\"";
        // line 13
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/section_edit/";
        echo ($context["type"] ?? null);
        echo "/\">
                    ";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_section"        ,"field_editor"        ,        );
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
        // line 15
        echo "                </a>
            </li>
            <li>
                <a href=\"";
        // line 18
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/sections/";
        echo ($context["type"] ?? null);
        echo "/sort\">
                    ";
        // line 19
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_sorting_mode"        ,"field_editor"        ,        );
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
        // line 20
        echo "                </a>
            </li>
        </ul>
    </div>
</div>
<div id=\"filter\" class=\"hide\">
  <div class=\"col-sm-3 col-xs-12\">
    <select id=\"section\" class=\"form-control\">
    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["types"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 29
            echo "        <option value=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" ";
            if ((($context["type"] ?? null) == $this->getAttribute($context["item"], "gid", []))) {
                echo "selected";
            }
            echo ">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "    </select>
  </div>
</div>
<table id=\"data\" cellspacing=\"0\" cellpadding=\"0\" class=\"table table-striped jambo_table\">
    <thead>
        <tr class=\"headings\">
            <th>";
        // line 37
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_section_name"        ,"field_editor"        ,        );
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
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    ";
        // line 42
        if (($context["sections"] ?? null)) {
            // line 43
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 44
                echo "        <tr>
            <td>";
                // line 45
                echo $this->getAttribute($context["item"], "name", []);
                echo "</td>
            <td class=\"icons\">
                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-primary\"
                            onclick=\"document.location.href = '";
                // line 49
                echo ($context["site_url"] ?? null);
                echo "admin/field_editor/section_edit/";
                echo ($context["type"] ?? null);
                echo "/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "'\">
                        ";
                // line 50
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_edit"                ,"start"                ,                );
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
                // line 51
                echo "                    </button>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                            aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"";
                // line 59
                echo ($context["site_url"] ?? null);
                echo "admin/field_editor/section_edit/";
                echo ($context["type"] ?? null);
                echo "/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                ";
                // line 60
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_edit"                ,"start"                ,                );
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
                // line 61
                echo "                            </a>
                        </li>
                        <li>
                            <a href=\"";
                // line 64
                echo ($context["site_url"] ?? null);
                echo "admin/field_editor/section_delete/";
                echo ($context["type"] ?? null);
                echo "/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\"
                                onclick=\"javascript: if (!confirm('";
                // line 65
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("note_delete_section"                ,"field_editor"                ,""                ,"js"                ,                );
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
                // line 66
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
                // line 67
                echo "                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "    ";
        }
        // line 75
        echo "    </tbody>
</table>
";
        // line 77
        $this->loadTemplate("@app/pagination.twig", "sections_view_mode.twig", 77)->display($context);
        // line 78
        echo "
<script>
  \$(function() {
    \$(document).off('change', '#section', function(e) {
      location.href = '";
        // line 82
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/sections/' + \$(this).val();
    });
  });
</script>

<!-- Datatables -->
<script src=\"";
        // line 88
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/datatables/js/jquery.dataTables.js\"></script>
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#data').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 94
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
        // line 95
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_sections"        ,"field_editor"        ,        );
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
            \"dom\": 'T<\"clear\"><\"actions\"><\"filter\">lfrtip',
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
        var actions = \$(\"#actions\");
        \$('#data_wrapper').find('.actions').html(actions.html());
        actions.remove();
        var filter = \$(\"#filter\");
        \$('#data_wrapper').find('.filter').html(filter.html());
        actions.remove();
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "sections_view_mode.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  404 => 95,  381 => 94,  372 => 88,  363 => 82,  357 => 78,  355 => 77,  351 => 75,  348 => 74,  336 => 67,  315 => 66,  292 => 65,  284 => 64,  279 => 61,  258 => 60,  250 => 59,  240 => 51,  219 => 50,  211 => 49,  204 => 45,  201 => 44,  196 => 43,  194 => 42,  167 => 37,  159 => 31,  144 => 29,  140 => 28,  130 => 20,  109 => 19,  103 => 18,  98 => 15,  77 => 14,  71 => 13,  61 => 5,  40 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "sections_view_mode.twig", "/home/mliadov/public_html/application/modules/field_editor/views/gentelella/sections_view_mode.twig");
    }
}
