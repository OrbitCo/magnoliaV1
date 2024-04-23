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

/* helper_module_instructions.twig */
class __TwigTemplate_8d3b4fed5800998ad14bc1d4e68c132a60a6f0eb864312f8c0ecab44034a89a2 extends \Twig\Template
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
        echo "<div class=\"instruction-block\">
    <div class=\"instruction-block__button\" id=\"btn-show-help\" data-toggle=\"popover\" data-content=\"";
        // line 2
        echo ($context["instruction_text"] ?? null);
        echo "\">
        <i class=\"fa fa-info\" id=\"instruction-icon\" aria-hidden=\"true\" title=\"";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_instruction_text"        ,"admin_instructions_page"        ,        );
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
        echo "\"></i>
    </div>
</div>

<script type=\"text/javascript\">
    \$(function () {
        \$('#btn-show-help').popover({placement: 'right', html: true});
        \$('#btn-show-help').on('show.bs.popover', function () {
            \$(\"#instruction-icon\").removeClass('fa-info');
            \$(\"#instruction-icon\").addClass('fa-times');
            ";
        // line 13
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("main"        ,"btn_info"        ,        );
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
        // line 14
        echo "        });
        \$('#btn-show-help').on('hide.bs.popover', function () {
            \$(\"#instruction-icon\").removeClass('fa-times');
            \$(\"#instruction-icon\").addClass('fa-info');
        });
        
        \$('html').on('click', function(e){
            var target = \$(e.target).attr('id');
            if (target !== 'btn-show-help' && target !== 'instruction-icon') { 
                \$('#btn-show-help').popover('hide');
            }
            
        });
    })
</script>   


";
    }

    public function getTemplateName()
    {
        return "helper_module_instructions.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 14,  69 => 13,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_module_instructions.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\gentelella\\helper_module_instructions.twig");
    }
}
