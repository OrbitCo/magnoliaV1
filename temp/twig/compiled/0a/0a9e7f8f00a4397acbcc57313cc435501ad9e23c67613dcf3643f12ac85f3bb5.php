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

/* list.twig */
class __TwigTemplate_f15d789c4794e868b5f80d5ea6ad0a651c15eff29b0ad95bc0b22b5798185f72 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display(twig_array_merge($context, ["load_type" => "editable|ui"]));
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
      <div class=\"x_content\">
        <!-- 1 level menu: language menu -->
        <div id=\"menu\" class=\"btn-group pull-right\" data-toggle=\"buttons\">
            ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
            // line 9
            echo "                <label class=\"btn btn-default ";
            if (($context["lang_id"] == ($context["current_lang"] ?? null))) {
                echo "active";
            }
            echo "\"
                       onclick=\"document.location.href='";
            // line 10
            echo ($context["site_url"] ?? null);
            echo "admin/content/index/";
            echo $context["lang_id"];
            echo "'\">
                    <input type=\"radio\" ";
            // line 11
            if (($context["lang_id"] == ($context["current_lang_id"] ?? null))) {
                echo "selected";
            }
            echo ">
                    ";
            // line 12
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                </label>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "        </div>

        <!-- 2 level menu: main content menu -->
        <div id=\"actions\">
          <div class=\"btn-group\">
            <a href=\"";
        // line 20
        echo ($context["site_url"] ?? null);
        echo "admin/content/edit/";
        echo ($context["current_lang"] ?? null);
        echo "/0\" class=\"btn btn-primary\">
                ";
        // line 21
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_page"        ,"content"        ,        );
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
        // line 22
        echo "            </a>
            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
              <span class=\"caret\"></span>
              <span class=\"sr-only\">Toggle Dropdown</span>
            </button>
              <ul class=\"dropdown-menu\">
                <li>
                  <a href=\"";
        // line 30
        echo ($context["site_url"] ?? null);
        echo "admin/content/edit/";
        echo ($context["current_lang"] ?? null);
        echo "/0\">
                      ";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_page"        ,"content"        ,        );
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
        // line 32
        echo "                  </a>
                </li>
        ";
        // line 34
        if (($context["pages"] ?? null)) {
            // line 35
            echo "                <li>
                  <a href=\"#\" onclick=\"javascript: mlSorter.update_sorting();return false\">
                      ";
            // line 37
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_save_sorter"            ,"content"            ,            );
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
            // line 38
            echo "                  </a>
                </li>
        ";
        }
        // line 41
        echo "          </div>
        </div>
      </div>

        <div class=\"x_content\" id=\"pages\">
            <ul name=\"parent_0\" class=\"to_do sort connected\" id=\"clsr0ul\">
                ";
        // line 47
        $this->loadTemplate("tree_level.twig", "list.twig", 47)->display(twig_array_merge($context, ["list" => ($context["pages"] ?? null)]));
        // line 48
        echo "            </ul>
        </div>
    </div>
</div>

<script >
    var mlSorter;
    \$(function () {
        mlSorter = new multilevelSorter({
            siteUrl: '";
        // line 57
        echo ($context["site_url"] ?? null);
        echo "',
            itemsBlockID: 'pages',
            urlSaveSort: 'admin/content/ajax_save_sorter',
            urlDeleteItem: 'admin/content/ajax_delete/',
            onActionUpdate: true,
        });
    });
</script>

";
        // line 66
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
        // line 67
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<script type=\"text/javascript\">
    function activatePage(id, status, a_obj) {
        \$.get(
            site_url+'admin/content/ajax_activate/' + status + '/' + id,
            {},
            function(resp) {
              \$(a_obj).parents('.js-page').first().find('.hide')
                      .removeClass('hide').siblings().addClass('hide');
            },
            'json'
        );
    }
</script>

";
        // line 83
        $this->loadTemplate("@app/footer.twig", "list.twig", 83)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  254 => 83,  233 => 67,  212 => 66,  200 => 57,  189 => 48,  187 => 47,  179 => 41,  174 => 38,  153 => 37,  149 => 35,  147 => 34,  143 => 32,  122 => 31,  116 => 30,  106 => 22,  85 => 21,  79 => 20,  72 => 15,  63 => 12,  57 => 11,  51 => 10,  44 => 9,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/content/views/gentelella/list.twig");
    }
}
