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

/* ajax_gift_selected_form.twig */
class __TwigTemplate_bafb654708f85b0c9eac6b85f5434a736da3f9839554744310a2d48b8a8b9b0e extends \Twig\Template
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
        echo "<div class=\"gift-selected-wrapper\">
    <a onclick=\"get_back();\" class=\"gift-selected-get-back\"><i class=\"fas fa-long-arrow-alt-left\"></i> ";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("get_back_to_gift_select"        ,"virtual_gifts"        ,        );
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
    <div class=\"selected-gift\">
        <img src=\"";
        // line 4
        echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gift_data"] ?? null), "mediafile", []), "thumbs_data", []), "big", []), "file_url", []);
        echo "\">
    </div>
    <p align=\"center\" class=\"selected-gift-price\">";
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_price"        ,"virtual_gifts"        ,        );
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
        echo ": <strong>";
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
        $params = array(["value" => $this->getAttribute(($context["gift_data"] ?? null), "price", [])]        ,        );
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
        echo "</strong></p>
    <div class=\"form-group selected-gift-comment\">
        <textarea id=\"comment-input\" class=\"form-control\" maxlength=\"130\" 
                  placeholder=\"";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_write_comment"        ,"virtual_gifts"        ,        );
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
        echo "\"></textarea>
        <p class=\"selected-gift-comment_symbols\">";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_comment_field_symbol_left"        ,"virtual_gifts"        ,        );
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
        echo ":<span id=\"symbols\">130</span></p>
    </div>
    <div class=\"form-group selected-gift-private\">
        <label class=\"checkbox-inline\"><input type=\"checkbox\" id=\"private-input\" class=\"is_private\"> ";
        // line 13
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_label_make_private"        ,"virtual_gifts"        ,        );
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
    </div>
    <div class=\"form-group send-gift-form send-gift-btn-block\">
        <button id=\"send-gift-btn\" class=\"btn btn-primary send-gift-btn\">";
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("send_gift"        ,"virtual_gifts"        ,        );
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
        echo "</button>
    </div>
    <div class=\"clearfix\"></div>
</div>
<div id=\"gift-id\" style=\"display:none;\" value=\"";
        // line 20
        echo $this->getAttribute(($context["gift_data"] ?? null), "id", []);
        echo "\"></div>
<script>
    var maxLength = \$('#comment-input').attr('maxlength');
    \$('#comment-input').keyup(function()
    {
        var curLength = \$('#comment-input').val().length;
        \$(this).val(\$(this).val().substr(0, maxLength));
        var remaining = maxLength - curLength;
        if (remaining < 0) remaining = 0;
        \$('#symbols').html(remaining);
    });
    \$('.send-gift-btn-block').on('click', '.send-gift-btn', function(){
            var gift_id = \$('#gift-id').attr('value');
            var comment = \$('#comment-input').val();
            var is_private = \$('#private-input').is(':checked');
            is_private = is_private ? 1 : 0;
            var send_data = {
                       \"comment\":comment,
                       \"is_private\":is_private
                       };
            \$.ajax({
                url: site_url + \"virtual_gifts/ajax_send_gift/\" + \"";
        // line 41
        echo ($context["user_id"] ?? null);
        echo "/\" + gift_id,
                method: \"POST\",
                data: send_data,
                dataType: \"json\",
                success: function(data){
                            if(data.redirect) {
                                error_object.show_error_block(data.errors, 'error');
                                locationHref(data.redirect);
                            } else {
                                \$('.gifts-list-block').html(data.content);
                            }
                        }
            });
    });
    var get_back = function(){
        \$.ajax({
            url: site_url + \"virtual_gifts/ajax_get_gifts_form/";
        // line 57
        echo ($context["user_id"] ?? null);
        echo "\",
            method: \"POST\",
            dataType: \"html\",
            data: {\"parted\":\"1\"},
            success: function(data){
                    if (data.errors) {
                            error_object.show_error_block(data.errors, 'error');
                    } else {
                        \$('.gifts-list-block').closest('.modal-body').html(data);
                    }
            }
        });
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "ajax_gift_selected_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  250 => 57,  231 => 41,  207 => 20,  181 => 16,  156 => 13,  131 => 10,  108 => 9,  62 => 6,  57 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_gift_selected_form.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/flatty/ajax_gift_selected_form.twig");
    }
}
