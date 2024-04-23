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

/* view_media.twig */
class __TwigTemplate_10bd9e3f181f28cc27d52974bd235e315a1510ead22892d25f2f8910d8181617 extends \Twig\Template
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
        echo "<div class=\"media-gallery-content\" id=\"image_content\"></div>
<script type=\"text/javascript\">
    \$(function(){
        loadScripts(
            \"";
        // line 5
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"edit_media.js"        ,"path"        ,        );
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
        echo "\",
            function(){
                ep = new editMedia({
                    siteUrl: site_url,
                    mediaId: '";
        // line 9
        echo ($context["media_id"] ?? null);
        echo "',
                    galleryContentParam: '";
        // line 10
        echo ($context["param"] ?? null);
        echo "',
                    albumId: '";
        // line 11
        echo ($context["album_id"] ?? null);
        echo "',
                    ";
        // line 12
        if ((($context["user_type"] ?? null) == "admin")) {
            // line 13
            echo "                    recropUrl: 'admin/media/ajax_recrop/',
                    rotateUrl: 'admin/media/ajax_rotate/',
                    getMediaContentUrl: 'admin/media/ajax_get_media_content/',
                    userType: 'admin',
                    ";
        }
        // line 18
        echo "                    gallery_name: '";
        if (($context["gallery_name"] ?? null)) {
            echo ($context["gallery_name"] ?? null);
        } else {
            echo "mediagallery";
        }
        echo "',
                    selections:";
        // line 19
        echo twig_jsonencode_filter(($context["selections"] ?? null));
        echo ",
                    saveAfterSelect: true,
                    success_request: function(message) {
                        if (message){
                            error_object.show_error_block(message, 'success');
                        } else {
                            error_object.show_error_block('";
        // line 25
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("image_update_success"        ,"media"        ,""        ,"js"        ,        );
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
        echo "', 'success');
                        }
                    },
                    fail_request: function(message) {
                        error_object.show_error_block(message, 'error');
                    },
                    error_in_adding_to_favorites: '";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_in_adding_to_favorites"        ,"media"        ,""        ,"js"        ,""        ,"js"        ,        );
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
        echo "',
                    success_add_to_favorites: '";
        // line 32
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("success_add_to_favorites"        ,"media"        ,""        ,"js"        ,        );
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
        echo "',
                    rand_param: '',//";
        // line 33
        echo $this->getAttribute(twig_date_converter($this->env), "timestamp", []);
        echo ",
                    lang_delete_confirm: '";
        // line 34
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm"        ,"media"        ,""        ,"js"        ,        );
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
        echo "',
                    lang_delete_confirm_album: '";
        // line 35
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm_albums"        ,"media"        ,""        ,"js"        ,        );
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
        echo "'
                });
            },
            ['ep'],
            {async: true, cache: false}
        );
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "view_media.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  202 => 35,  179 => 34,  175 => 33,  152 => 32,  129 => 31,  101 => 25,  92 => 19,  83 => 18,  76 => 13,  74 => 12,  70 => 11,  66 => 10,  62 => 9,  36 => 5,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view_media.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/view_media.twig");
    }
}
