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

/* albums_list.twig */
class __TwigTemplate_27ae5eff78e95c45b1dc9fb32739492bd16a8ee609983ef8f50feb4c9975a509 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["albums"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["jey"] => $context["item"]) {
            // line 2
            echo "    <div class=\"g-users-gallery__item col-xs-6 col-sm-3 col-md-3 col-lg-2\" data-album-id=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
        <div class=\"album-bg\"></div>
        <div class=\"g-users-gallery__content\">
            <div class=\"g-users-gallery__photo\">
                <span class=\"g-pic-border g-rounded g-users-gallery__photo-img\" data-click=\"album\">
                    <img class=\"pointer\"
                         src=\"";
            // line 8
            if ($this->getAttribute($this->getAttribute($context["item"], "mediafile", []), "media", [])) {
                // line 9
                echo "                         ";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "mediafile", []), "media", []), "mediafile", []), "thumbs", []), "big", []);
                echo "
                         ";
            } elseif ($this->getAttribute($this->getAttribute(            // line 10
$context["item"], "mediafile", []), "video_content", [])) {
                // line 11
                echo "                             ";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "mediafile", []), "video_content", []), "thumbs", []), "big", []);
                echo "
                             ";
            }
            // line 12
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", []));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", []));
            echo "\" />
                         </span>
                         ";
            // line 14
            if ($this->getAttribute($this->getAttribute($context["item"], "mediafile", []), "video_content", [])) {
                // line 15
                echo "                             <div class=\"g-users-gallery__overlay-icon pointer\" data-click=\"album\">
                                 <i class=\"fa fa-play w fa-4x opacity60\"></i>
                             </div>
                         ";
            }
            // line 19
            echo "
                         ";
            // line 20
            if (($this->getAttribute($context["item"], "description", []) || ($context["is_user_album_owner"] ?? null))) {
                // line 21
                echo "                             <div class=\"g-users-gallery__actions\">
                                 <div class=\"g-photo-actions\">
                                     ";
                // line 23
                if (($context["is_user_album_owner"] ?? null)) {
                    // line 24
                    echo "                                         <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "media/edit_album/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"
                                            class=\"edit-album\">
                                             <i class=\"fas fa-pencil-alt edge w\"></i>
                                         </a>
                                     ";
                }
                // line 29
                echo "                                     ";
                if (($context["is_user_album_owner"] ?? null)) {
                    // line 30
                    echo "                                         <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "media/delete_album/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"
                                            class=\"delete-media\" data-album-id=\"";
                    // line 31
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                             <i class=\"fas fa-trash-alt w fa-lg\"></i>
                                         </a>
                                     ";
                }
                // line 35
                echo "                                 </div>
                             </div>
                         ";
            }
            // line 38
            echo "
                         <div class=\"g-users-gallery__overlayinfo\">
                             <div class=\"g-photo-statuses\">
                                 <div>
                                     <div class=\"g-photo-statuses__item g-photo-statuses__item_place\">
                                         <span title=\"";
            // line 43
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("album_items"            ,"media"            ,            );
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
            echo "\">";
            echo $this->getAttribute($context["item"], ($context["albums_count_field"] ?? null), [], "array");
            echo "</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </div>

                    <div class=\"g-users-gallery__info\">
                        <div class=\"g-users-gallery__date\" title=\"";
            // line 51
            echo $this->getAttribute($context["item"], "name", []);
            echo "\">
                            ";
            // line 52
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                        </div>
                        ";
            // line 54
            if (($this->getAttribute($context["item"], "description", []) || ($context["is_user_album_owner"] ?? null))) {
                // line 55
                echo "                            <s class=\"g-users-gallery__name\" title=\"";
                echo $this->getAttribute($context["item"], "description", []);
                echo "\">";
                echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", []), "html", null, true));
                echo "</s>
                            ";
            }
            // line 57
            echo "                    </div>
                </div>

            </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 62
            echo "                <div class=\"center\">
                    ";
            // line 63
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_albums"            ,"media"            ,            );
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
            echo ".
                    ";
            // line 64
            if (($context["is_user_album_owner"] ?? null)) {
                // line 65
                echo "                        <span class=\"pointer link-r-margin\" id=\"create_album_button\">
                            <a class=\"link-dashed\" href=\"javascript:void(0);\">";
                // line 66
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("create_album"                ,"media"                ,                );
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
                        </span>

                        <div class=\"pl10 mt10\">
                            <span class=\"hide form-inline\" id=\"create_album_container\">
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"text\" name=\"album_name\" id=\"album_name\">
                                </div>
                                <div class=\"form-group\">
                                    <button class=\"btn btn-primary\" id=\"save_album\">";
                // line 75
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_apply"                ,"start"                ,                );
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
                            </span>
                        </div>
                    ";
            }
            // line 80
            echo "                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['jey'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "
                    ";
        // line 83
        if ((($context["albums_page"] ?? null) == 1)) {
            // line 84
            echo "                        <script>
                            \$(function () {
                                loadScripts(
                                        \"";
            // line 87
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("media"            ,"albums.js"            ,"path"            ,            );
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
                                        function () {
                                            albums_list = new albums({
                                                siteUrl: site_url,
                                                contentDiv: '#gallery_content',
                                                edit_album_success_request: function () {
                                                    mediagallery.properties.galleryContentPage = 1,
                                                            mediagallery.properties.all_loaded = 0;
                                                    mediagallery.load_content(1);
                                                    error_object.show_error_block('";
            // line 96
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("album_update_success"            ,"media"            ,            );
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
                                                    this.windowObj.hide_load_block();
                                                },
                                            });
                                        },
                                        ['albums_list'],
                                        {async: false}
                                );
                            });
                        </script>
                    ";
        }
    }

    public function getTemplateName()
    {
        return "albums_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  324 => 96,  293 => 87,  288 => 84,  286 => 83,  283 => 82,  276 => 80,  249 => 75,  218 => 66,  215 => 65,  213 => 64,  190 => 63,  187 => 62,  178 => 57,  170 => 55,  168 => 54,  163 => 52,  159 => 51,  127 => 43,  120 => 38,  115 => 35,  108 => 31,  101 => 30,  98 => 29,  87 => 24,  85 => 23,  81 => 21,  79 => 20,  76 => 19,  70 => 15,  68 => 14,  60 => 12,  54 => 11,  52 => 10,  47 => 9,  45 => 8,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "albums_list.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/albums_list.twig");
    }
}
