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

/* countries_view_mode.twig */
class __TwigTemplate_fb806395fea8bf268db5b2a0b1611473a7c5d30f27d66f3a4fc909d8aa1a9bf5 extends \Twig\Template
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
        echo "admin/countries/country_edit\" class=\"btn btn-primary\">
        ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_country"        ,"countries"        ,        );
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
        echo "    </a>
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
        echo "admin/countries/country_edit\">
          ";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_country"        ,"countries"        ,        );
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
        echo "admin/countries/index/1\">
          ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_sorting_mode"        ,"countries"        ,        );
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
<table id=\"data\" class=\"table table-striped responsive-utilities jambo_table\">
  <thead>
    <tr class=\"headings\">
      <th class=\"column-title\">";
        // line 26
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_code"        ,"countries"        ,        );
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
        // line 27
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_name"        ,"countries"        ,        );
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
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["installed"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 33
            echo "    <tr class=\"even pointer\">
      <td class=\"text-center\">";
            // line 34
            echo $this->getAttribute($context["item"], "code", []);
            echo "</td>
      <td>";
            // line 35
            echo $this->getAttribute($context["item"], "name", []);
            echo "</td>
      <td class=\"icons\">
        <div class=\"btn-group\">
          <a href=\"";
            // line 38
            echo ($context["site_url"] ?? null);
            echo "admin/countries/country/";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\" class=\"btn btn-primary\">
            ";
            // line 39
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("view_regions_link"            ,"countries"            ,            );
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
            // line 47
            echo ($context["site_url"] ?? null);
            echo "admin/countries/country/";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\">
                ";
            // line 48
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("view_regions_link"            ,"countries"            ,            );
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
            // line 51
            echo ($context["site_url"] ?? null);
            echo "admin/countries/country_edit/";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\">
                ";
            // line 52
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_edit_country"            ,"countries"            ,            );
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
            // line 55
            echo ($context["site_url"] ?? null);
            echo "admin/countries/country_delete/";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\"
                  onclick=\"javascript: if (!confirm('";
            // line 56
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("note_delete_country"            ,"countries"            ,""            ,"js"            ,            );
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
            // line 57
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_delete_country"            ,"countries"            ,            );
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
      </td>
    </tr>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "  </tbody>
</table>

<!-- Datatables -->
<script src=\"";
        // line 68
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/datatables/js/jquery.dataTables.js\"></script>
<script>
  var asInitVals = new Array();
  \$(document).ready(function () {
    var oTable = \$('#data').dataTable({
      \"oLanguage\": {
        \"sSearch\": \"";
        // line 74
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
        // line 75
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_countries"        ,"countries"        ,        );
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
";
    }

    public function getTemplateName()
    {
        return "countries_view_mode.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  396 => 75,  373 => 74,  364 => 68,  358 => 64,  326 => 57,  303 => 56,  297 => 55,  272 => 52,  266 => 51,  241 => 48,  235 => 47,  205 => 39,  199 => 38,  193 => 35,  189 => 34,  186 => 33,  182 => 32,  155 => 27,  132 => 26,  102 => 18,  98 => 17,  73 => 14,  69 => 13,  59 => 5,  38 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "countries_view_mode.twig", "/home/mliadov/public_html/application/modules/countries/views/gentelella/countries_view_mode.twig");
    }
}
