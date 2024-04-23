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

/* items_list.twig */
class __TwigTemplate_79d5b3d510ed96c6093eaebf24596c3fb12b5fc96ddf6b681787932898e2ffab extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "items_list.twig", 1)->display(twig_array_merge($context, ["load_type" => "editable|ui"]));
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div id=\"actions\" class=\"x_content\">
          <div class=\"btn-group\">
            <a href=\"";
        // line 7
        echo ($context["site_url"] ?? null);
        echo "admin/menu/items_edit/";
        echo $this->getAttribute(($context["menu_data"] ?? null), "id", []);
        echo "\" class=\"btn btn-primary\">
                ";
        // line 8
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_menu_item"        ,"menu"        ,        );
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
        echo "            </a>
            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                    aria-haspopup=\"true\" aria-expanded=\"false\">
                <span class=\"caret\"></span>
                <span class=\"sr-only\">Toggle Dropdown</span>
            </button>
            <ul class=\"dropdown-menu\">
              <li>
                <a href=\"";
        // line 17
        echo ($context["site_url"] ?? null);
        echo "admin/menu/items_edit/";
        echo $this->getAttribute(($context["menu_data"] ?? null), "id", []);
        echo "\">
                    ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_menu_item"        ,"menu"        ,        );
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
        // line 19
        echo "                </a>
              </li>
              <li>
                <a href=\"#\" onclick=\"javascript: mlSorter.update_sorting(); return false;\">
                    ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_save_sorter"        ,"menu"        ,        );
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
        // line 24
        echo "                </a>
              </li>
            </ul>
          </div>
        </div>
       <script type=\"text/javascript\">
            var mlSorter;
            \$(function () {
                mlSorter = new multilevelSorter({
                    siteUrl: '";
        // line 33
        echo ($context["site_url"] ?? null);
        echo "',
                    urlSaveSort: 'admin/menu/ajax_save_item_sorter',
                    urlDeleteItem: 'admin/menu/ajax_item_delete/',
                    onActionUpdate: true,
                    itemIds: ['#clsr0ul'],
                    subItemsIds: [],
                    isFinaliSortable: true
                });
            });
        </script>
        <div class=\"x_content\">
          <div id=\"menu_items\">
              <ul name=\"parent_0\" class=\"to_do sort connected\" id=\"clsr0ul\">
                  ";
        // line 46
        $this->loadTemplate("tree_level.twig", "items_list.twig", 46)->display(twig_array_merge($context, ["list" => ($context["menu"] ?? null), "main" => true]));
        // line 47
        echo "              </ul>
          </div>
        </div>
    </div>
</div>
<script type=\"text/javascript\">
    \$(function () {
        mlSorter.set_sortable(mlSorter.properties.itemIds);
        //mlSorter.update_closers();
    });
  \$('#menu_items').find('li').off('click').on('click', '.js-activate', function(){
      var action = \$(this).data(\"action\");
      var item_id = \$(this).data(\"id\");
      \$.ajax({
          url: \"";
        // line 61
        echo ($context["site_url"] ?? null);
        echo "admin/menu/ajax_item_activate/\" + action + \"/\" + item_id,
          type: 'get',
          cache: false,
          success: function(data) {
             if (action == 1) {
                \$(this).parents('.js-item').find('[data-action=\"0\"].js-toggle-title').addClass('hide');
                \$(this).parents('.js-item').find('[data-action=\"1\"].js-toggle-title').removeClass('hide');
                \$('[data-id=\"' + item_id + '\"][data-action=\"1\"]').addClass('hide');
                \$('[data-id=\"' + item_id + '\"][data-action=\"0\"]').removeClass('hide');
            } else {
                \$(this).parents('.js-item').find('[data-action=\"1\"].js-toggle-title').addClass('hide');
                \$(this).parents('.js-item').find('[data-action=\"0\"].js-toggle-title').removeClass('hide');
                \$('[data-id=\"' + item_id + '\"][data-action=\"0\"]').addClass('hide');
                \$('[data-id=\"' + item_id + '\"][data-action=\"1\"]').removeClass('hide');
           }
          }.bind(this)
      });
  });
</script>

";
        // line 81
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
        // line 82
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

";
        // line 84
        $this->loadTemplate("@app/footer.twig", "items_list.twig", 84)->display($context);
    }

    public function getTemplateName()
    {
        return "items_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 84,  219 => 82,  198 => 81,  175 => 61,  159 => 47,  157 => 46,  141 => 33,  130 => 24,  109 => 23,  103 => 19,  82 => 18,  76 => 17,  66 => 9,  45 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "items_list.twig", "/home/mliadov/public_html/application/modules/menu/views/gentelella/items_list.twig");
    }
}
