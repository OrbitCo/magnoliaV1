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

/* install_region_list.twig */
class __TwigTemplate_f7d33dd6a6e3ec0bc005dc9ad4b3de2ca9684b82c65626fd345c1de3c9574741 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "install_region_list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <!--1 level menu-->
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 8
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_countries_menu"        ,        );
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
        echo "            </ul>
        </div>
        <div class='x_content'>
            <form action=\"";
        // line 12
        echo ($context["site_url"] ?? null);
        echo "admin/countries/install/city/";
        echo $this->getAttribute(($context["country"] ?? null), "code", []);
        echo "\" method=\"post\">
                <div id=\"actions\" class=\"hide\">
                  <div class=\"btn-group\">
                    <button type=\"submit\" name=\"install-btn\" class=\"btn btn-primary\"
                           value=\"1\" onclick=\"javascript: return checkBoxes();\" id=\"install-all\">
                           ";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("install_regions_link"        ,"countries"        ,        );
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
        // line 18
        echo "                    </button>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                          <a href=\"javascript:;\" onclick=\"javascript: \$('#install-all').trigger('click');\">
                            ";
        // line 27
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("install_regions_link"        ,"countries"        ,        );
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
        // line 28
        echo "                          </a>
                        </li>
                    </ul>
                  </div>
                </div>
                <table id=\"data\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
                    <thead>
                        <tr class=\"headings\">
                            <th class=\"text-center\">
                                <input type=\"checkbox\" id=\"check-all\" class=\"flat\">
                            </th>
                            <th class=\"column-title text-center\">";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country"        ,"countries"        ,        );
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
                            <th class=\"column-title text-center\">";
        // line 40
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_region_code"        ,"countries"        ,        );
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
                            <th class=\"column-title\">";
        // line 41
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_region_name"        ,"countries"        ,        );
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
                            <th class=\"column-title text-center\">";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_region_status"        ,"countries"        ,        );
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
                            <th class=\"bulk-actions\" colspan=\"5\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 48
            echo "                            <tr class=\"";
            if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [$this->getAttribute($context["item"], "net_is_incomer", [])])) {
                echo "net_incomer ";
            }
            echo "even pointer\">
                                <td class=\"text-center\">
                                    ";
            // line 50
            if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [$this->getAttribute($context["item"], "net_is_incomer", [])])) {
                // line 51
                echo "                                        <div class=\"corner-triangle\"></div>
                                    ";
            }
            // line 53
            echo "                                    <input type=\"checkbox\" class=\"tableflat grouping ch-reg\" value=\"";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\"  name=\"region[]\" data='table_records' ";
            if ($this->getAttribute(($context["installed"] ?? null), $this->getAttribute($context["item"], "code", []), [], "array")) {
                echo " disabled ";
            }
            echo ">
                                </td>
                                <td class=\"text-center\">";
            // line 55
            echo $this->getAttribute(($context["country"] ?? null), "name", []);
            echo " (";
            echo $this->getAttribute(($context["country"] ?? null), "code", []);
            echo ")</td>
                                <td class=\"text-center\">";
            // line 56
            echo $this->getAttribute($context["item"], "code", []);
            echo "</td>
                                <td>";
            // line 57
            echo $this->getAttribute($context["item"], "name", []);
            echo "</td>
                                <td class=\"text-center\">
                                    ";
            // line 59
            if ($this->getAttribute(($context["installed"] ?? null), $this->getAttribute($context["item"], "code", []), [], "array")) {
                echo "<i>
                                        ";
                // line 60
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("region_installed"                ,"countries"                ,                );
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
                echo "</i>
                                    ";
            } else {
                // line 62
                echo "                                        <i>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("region_not_installed"                ,"countries"                ,                );
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
                echo "</i>
                                    ";
            }
            // line 63
            echo "&nbsp;
                                </td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
";
        // line 73
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
        // line 74
        echo "
<link href=\"";
        // line 75
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<!-- Datatables -->
<script src=\"";
        // line 78
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/datatables/js/jquery.dataTables.js\"></script>
<!-- Datatables -->
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        var oTable = \$('#data').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 89
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
                \"sEmptyTable\": \"\"
            },
            \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': []
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bSort\": false,
            \"bFilter\": false,
            \"bInfo\": false,
            \"dom\": 'T<\"clear\"><\"actions\">lfrtip',
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
    });
</script>

<script>
    /*\$(document).ready(function () {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });*/
    function checkBoxes(){
        if(\$('.ch-reg:checked').length > 0){
            return true;
        } else {
            return false;
        }
    }
</script>

";
        // line 146
        $this->loadTemplate("@app/footer.twig", "install_region_list.twig", 146)->display($context);
    }

    public function getTemplateName()
    {
        return "install_region_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  475 => 146,  396 => 89,  382 => 78,  375 => 75,  372 => 74,  351 => 73,  343 => 67,  334 => 63,  309 => 62,  285 => 60,  281 => 59,  276 => 57,  272 => 56,  266 => 55,  256 => 53,  252 => 51,  250 => 50,  242 => 48,  238 => 47,  211 => 42,  188 => 41,  165 => 40,  142 => 39,  129 => 28,  108 => 27,  97 => 18,  76 => 17,  66 => 12,  61 => 9,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "install_region_list.twig", "/home/mliadov/public_html/application/modules/countries/views/gentelella/install_region_list.twig");
    }
}
