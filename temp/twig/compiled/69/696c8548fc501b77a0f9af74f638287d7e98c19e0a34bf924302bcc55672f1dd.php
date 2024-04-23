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

/* helper_is_terms.twig */
class __TwigTemplate_a1fc5c5fe554ca9dc948c74113678be2c5b3f2593f8c6d1bd341b2c453f84f84 extends \Twig\Template
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
        echo "<script>
    \$(function () {
        var termBlock = new loadingContent({
            otherClass: 'col-md-5 col-md-offset-4 col-lg-5 col-lg-offset-4'
        });
        var htmlObj = \"<div>\";
            htmlObj += \"<h3>";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("welcome"        ,"users"        ,        );
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
        echo "</h3>\";
            htmlObj += \"<div class='form-group'>";
        // line 8
        echo ($context["data_terms"] ?? null);
        echo "</div>\";
            htmlObj += \"<div><div><button type='button' class='btn btn-primary' id='i_agree'>";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_i_agree"        ,"users"        ,        );
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
        echo "</button></div></div>\";
            htmlObj += \"</div>\";

        termBlock.show_load_block(htmlObj);
      
        \$('#i_agree').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            var data = '&agree=' + 1;
            \$.ajax({
                url: site_url + 'users/i_agree_terms',
                dataType: 'json',
                type: 'post',
                data: data,
                cache: false,
                success: function (data) {
                    console.log(data);
                    if (typeof data.success !== 'undefined') {
                        termBlock.hide_load_block();
                        error_object.show_error_block(data.success, 'success');
                    }
                }
            });
        });
    });
</script>";
    }

    public function getTemplateName()
    {
        return "helper_is_terms.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 9,  61 => 8,  38 => 7,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_is_terms.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\helper_is_terms.twig");
    }
}
