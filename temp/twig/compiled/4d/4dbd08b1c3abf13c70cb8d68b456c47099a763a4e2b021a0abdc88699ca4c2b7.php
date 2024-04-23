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

/* list_fields_list.twig */
class __TwigTemplate_70253f7bb8a9040d23e85e665353b9d2b5339cac949e1eb45b61da0a6417e8cb extends \Twig\Template
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
        <div id=\"actions\" class=\"hide\">
          <div class=\"btn-group\">
            <a class=\"btn btn-primary\" href=\"";
        // line 4
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/field_edit/";
        echo ($context["type"] ?? null);
        echo "/";
        echo ($context["section"] ?? null);
        echo "\">
                ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_field"        ,"field_editor"        ,        );
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
        echo "</a>
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
        echo "admin/field_editor/field_edit/";
        echo ($context["type"] ?? null);
        echo "/";
        echo ($context["section"] ?? null);
        echo "\">
                    ";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_field"        ,"field_editor"        ,        );
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
        echo "</a>
              </li>
              <li>
                <a href=\"";
        // line 17
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/fields/";
        echo ($context["type"] ?? null);
        echo "/";
        echo ($context["section"] ?? null);
        echo "/sort\">
                  ";
        // line 18
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
        echo "</a>
              </li>
            </ul>
          </div>
        </div>
        <div id=\"filter\" class=\"hide\">
          <div class=\"row form-group\">
            <div class=\"col-md-2 col-sm-2 col-xs-12\">
              <select id=\"section\" class=\"form-control\">
              ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["types"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 28
            echo "                <option value=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" ";
            if ((($context["type"] ?? null) == $this->getAttribute($context["item"], "gid", []))) {
                echo "selected";
            }
            echo ">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</options>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "              </select>
            </div>
            <div class=\"col-md-2 col-sm-2 col-xs-12\">
              <select name=\"section\" onchange=\"javascript: reload_this_page(this.value);\" class=\"form-control\">
              ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 35
            echo "                <option value=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" ";
            if ((($context["section"] ?? null) == $this->getAttribute($context["item"], "gid", []))) {
                echo "selected";
            }
            echo ">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</option>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "            </select>
            </div>
          </div>
        </div>
        <table id=\"data\" cellspacing=\"0\" cellpadding=\"0\" class=\"table table-striped jambo_table\" width=\"100%\">
            <thead>
                <tr>
                    <th>";
        // line 44
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_field_name"        ,"field_editor"        ,        );
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
                    <th>";
        // line 45
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_field_type"        ,"field_editor"        ,        );
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
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 51
            echo "              <tr>
                <td>";
            // line 52
            echo $this->getAttribute($context["item"], "name", []);
            echo "</td>
                <td>";
            // line 53
            echo $this->getAttribute($context["item"], "field_type", []);
            echo "</td>
                <td class=\"icons\">
                  <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-primary\"
                            onclick=\"document.location.href = '";
            // line 57
            echo ($context["site_url"] ?? null);
            echo "admin/field_editor/field_edit/";
            echo ($context["type"] ?? null);
            echo "/";
            echo ($context["section"] ?? null);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "'\">
                      ";
            // line 58
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
            // line 59
            echo "                    </button>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                            aria-haspopup=\"true\" aria-expanded=\"false\">
                      <span class=\"caret\"></span>
                      <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                      <li>
                        <a href=\"";
            // line 67
            echo ($context["site_url"] ?? null);
            echo "admin/field_editor/field_edit/";
            echo ($context["type"] ?? null);
            echo "/";
            echo ($context["section"] ?? null);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                          ";
            // line 68
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
            // line 69
            echo "                        </a>
                      </li>
                      <li>
                        <a href=\"";
            // line 72
            echo ($context["site_url"] ?? null);
            echo "admin/field_editor/field_delete/";
            echo ($context["type"] ?? null);
            echo "/";
            echo ($context["section"] ?? null);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                          ";
            // line 73
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_delete"            ,"start"            ,            );
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
            // line 74
            echo "                        </a>
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
        // line 81
        echo "            </tbody>
        </table>
        ";
        // line 83
        $this->loadTemplate("@app/pagination.twig", "list_fields_list.twig", 83)->display($context);
        // line 84
        echo "
        <script>
          \$(function() {
            \$(document).off('change', '#section', function(e) {
              location.href = '";
        // line 88
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/fields/' + \$(this).val();
            });
          });
        </script>

        <script type=\"text/javascript\">
            var reload_link = \"";
        // line 94
        echo ($context["site_url"] ?? null);
        echo "admin/field_editor/fields/";
        echo ($context["type"] ?? null);
        echo "/\";
            function reload_this_page(value) {
                var link = reload_link + value;
                location.href = link;
            }
        </script>

        <!-- Datatables -->
        <script src=\"";
        // line 102
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/datatables/js/jquery.dataTables.js\"></script>
        <script>
            var asInitVals = new Array();
            \$(document).ready(function () {
                var oTable = \$('#data').dataTable({
                    \"oLanguage\": {
                        \"sSearch\": \"";
        // line 108
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
        // line 109
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_fields"        ,"field_editor"        ,        );
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
                            'aTargets': [2]
                        } //disables sorting for column one
                    ],
                    'iDisplayLength': 10,
                    \"bPaginate\": false,
                    \"bInfo\": false,
                    \"dom\": 'T<\"clearfix\"><\"filter\"><\"clearfix\"><\"actions\">lfrtip',
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
                filter.remove();
            });
        </script>
";
    }

    public function getTemplateName()
    {
        return "list_fields_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  452 => 109,  429 => 108,  420 => 102,  407 => 94,  398 => 88,  392 => 84,  390 => 83,  386 => 81,  374 => 74,  353 => 73,  343 => 72,  338 => 69,  317 => 68,  307 => 67,  297 => 59,  276 => 58,  266 => 57,  259 => 53,  255 => 52,  252 => 51,  248 => 50,  221 => 45,  198 => 44,  189 => 37,  174 => 35,  170 => 34,  164 => 30,  149 => 28,  145 => 27,  114 => 18,  106 => 17,  81 => 14,  73 => 13,  43 => 5,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_fields_list.twig", "/home/mliadov/public_html/application/modules/field_editor/views/gentelella/list_fields_list.twig");
    }
}
