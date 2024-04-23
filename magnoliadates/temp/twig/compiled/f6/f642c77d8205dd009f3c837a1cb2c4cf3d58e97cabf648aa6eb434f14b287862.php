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

/* ajax_delete_select_block.twig */
class __TwigTemplate_dc46ae900c226e7f38844cc2c1c0875339fee8cda0a417d919229fd770b9dcba extends \Twig\Template
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
    <div class=\"inside\">
        <form id=\"delete_user\" class=\"\" action=\"";
        // line 3
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
            <label class=\"col-xs-12\">
              ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("success_text_delete"        ,"media"        ,        );
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
        </form>
    </div>
</div>

<script type=\"text/javascript\">
    \$(function () {
        \$(document).off('click', '#lie_delete').on('click', '#lie_delete', function() {
          \$('#delete_user').submit();
        });
        \$('#delete_user').unbind('submit').on('submit', function (e) {
            e.preventDefault();
            var data = new Array();
            \$('.grouping:checked').each(function (i) {
                data[i] = \$(this).val();
            });
            if (data.length > 0) {
                \$.ajax({
                    url: site_url + 'admin/media/ajax_delete_media/',
                    data: {file_ids: data},
                    type: \"POST\",
                    cache: false,
                    success: function (data) {
                        reload_this_page('index/' + param);
                    }
                });
            }
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "ajax_delete_select_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 5,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_delete_select_block.twig", "/home/mliadov/public_html/application/modules/media/views/gentelella/ajax_delete_select_block.twig");
    }
}
