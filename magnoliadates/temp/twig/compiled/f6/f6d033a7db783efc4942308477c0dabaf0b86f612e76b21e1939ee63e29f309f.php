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
class __TwigTemplate_d0bf66d00ab8c28f860a7f02128b4aa931eee7fb82fefc6e86a7c3c11f934497 extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["media"] ?? null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 2
            echo "    ";
            if (((($this->getAttribute($context["item"], "status", []) != 1) || ($this->getAttribute($context["item"], "permissions", []) == 0)) || ($this->getAttribute(            // line 3
$context["item"], "id_parent", []) && (($this->getAttribute($context["item"], "media", []) &&  !$this->getAttribute($context["item"], "mediafile", [])) || ($this->getAttribute(            // line 4
$context["item"], "video_content", []) &&  !$this->getAttribute($context["item"], "media_video", [])))))) {
                // line 5
                echo "    ";
                $context["is_active"] = "0";
            } else {
                // line 7
                echo "    ";
                $context["is_active"] = "1";
                // line 8
                echo "    ";
            }
            // line 9
            echo "        <div class=\"g-users-gallery__item col-xs-6 col-sm-6 col-md-4 col-lg-3\">
            <div class=\"g-users-gallery__content\">
                ";
            // line 11
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_audio")) {
                // line 12
                echo "                    ";
                $this->loadTemplate("view_audio_item.twig", "list.twig", 12)->display($context);
                // line 13
                echo "                ";
            } else {
                // line 14
                echo "                    <div class=\"g-users-gallery__photo ";
                if ( !($context["is_active"] ?? null)) {
                    echo "inactive";
                }
                echo "\">
                        ";
                // line 15
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_media_photo"                ,"media"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_media_photo'] = $result;
                // line 16
                echo "                        <a class=\"g-pic-border g-rounded g-users-gallery__photo-img\" href=\"javascript:void(0);\" data-click=\"view-media\" data-id-media=\"";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                            ";
                // line 17
                $module =                 null;
                $helper =                 'media';
                $name =                 'load_picture';
                $params = array(["thumbs" => (($this->getAttribute($this->getAttribute($this->getAttribute(                // line 18
($context["item"] ?? null), "media", []), "mediafile", []), "thumbs", [])) ? ($this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "media", []), "mediafile", []), "thumbs", [])) : ($this->getAttribute($this->getAttribute(($context["item"] ?? null), "video_content", []), "thumbs", []))), "size" => "big", "alt" =>                 // line 20
($context["text_media_photo"] ?? null), "class" => "pointer"]                ,                );
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
                echo "                        
                            
                        </a>
                        ";
                // line 25
                if (($this->getAttribute($context["item"], "status", []) == 0)) {
                    // line 26
                    echo "                            <div class=\"g-users-gallery__overlay-icon ";
                    if (($context["is_active"] ?? null)) {
                        echo "pointer";
                    }
                    echo "\"
                                 title=\"";
                    // line 27
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("moderation_wait"                    ,"media"                    ,                    );
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
                    echo "\">
                                <i class=\"far fa-clock w fa-4x opacity60\"></i>
                            </div>
                        ";
                } elseif (($this->getAttribute(                // line 30
$context["item"], "status", []) ==  -1)) {
                    // line 31
                    echo "                            <div class=\"g-users-gallery__overlay-icon ";
                    if (($context["is_active"] ?? null)) {
                        echo "pointer";
                    }
                    echo "\"
                                 title=\"";
                    // line 32
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("moderation_decline"                    ,"media"                    ,                    );
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
                    echo "\">
                                <i class=\"far fa-times-circle w fa-4x opacity60\"></i>
                            </div>
                        ";
                } elseif ($this->getAttribute(                // line 35
$context["item"], "video_content", [])) {
                    // line 36
                    echo "                            <div class=\"g-users-gallery__overlay-icon ";
                    if (($context["is_active"] ?? null)) {
                        echo "pointer";
                    }
                    echo "\"
                                 data-click=\"view-media\" data-id-media=\"";
                    // line 37
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                <i class=\"fa fa-play w fa-4x opacity60\"></i>
                            </div>
                        ";
                }
                // line 41
                echo "
                        <div class=\"g-users-gallery__actions\">
                            <div class=\"g-photo-actions\">
                                <a href=\"javascript:void(0);\" data-click=\"view-media\" class=\"hide\" data-id-media=\"";
                // line 44
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                    <i class=\"fas fa-pencil-alt\"></i>
                                </a>

                                <a href=\"";
                // line 48
                echo ($context["site_url"] ?? null);
                echo "media/delete_media/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" class=\"delete-media\">
                                    <i class=\"far fa-trash-alt\"></i>
                                </a>
                            </div><!-- g-photo-actions -->
                        </div>


                        <div class=\"g-users-gallery__overlayinfo\">
                            ";
                // line 56
                if (($this->getAttribute($context["item"], "permissions", []) == 0)) {
                    // line 57
                    echo "                                <p>
                                    ";
                    // line 58
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("permissions_restrict"                    ,"media"                    ,                    );
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
                    // line 59
                    echo "                                </p>
                            ";
                }
                // line 61
                echo "                            ";
                if (($this->getAttribute($context["item"], "id_parent", []) && (($this->getAttribute($context["item"], "media", []) &&  !$this->getAttribute($context["item"], "mediafile", [])) || ($this->getAttribute(                // line 62
$context["item"], "video_content", []) &&  !$this->getAttribute($context["item"], "media_video", []))))) {
                    // line 63
                    echo "                            <p>
                                ";
                    // line 64
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("media_deleted_by_owner"                    ,"media"                    ,                    );
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
                    // line 65
                    echo "                            </p>
                        ";
                }
                // line 67
                echo "                        <div class=\"g-photo-statuses\">
                            <div>
                                <div class=\"g-photo-statuses__item g-photo-statuses__item_place\" data-gid=\"media";
                // line 69
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                    <i class=\"far fa-eye\"></i>
                                    <span class=\"view_num\">";
                // line 71
                echo $this->getAttribute($context["item"], "views", []);
                echo "</span>
                                </div>
                                <div class=\"g-photo-statuses__item\">
                                    ";
                // line 74
                $module =                 null;
                $helper =                 'likes';
                $name =                 'like_block';
                $params = array(["gid" => ("media" . $this->getAttribute(                // line 75
($context["item"] ?? null), "id", [])), "type" => "button", "btn_class" => "edge w"]                ,                );
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
                // line 79
                echo "                                </div>
                                ";
                // line 80
                if ($this->getAttribute($context["item"], "is_adult", [])) {
                    // line 81
                    echo "                                    <div class=\"g-photo-statuses__item g-photo-statuses__item_place\">
                                        <i class=\"fa fa-female\"></i>
                                        <span>18+</span>
                                    </div>
                                ";
                }
                // line 86
                echo "                                ";
                if (($this->getAttribute($context["item"], "id_user", []) != $this->getAttribute($context["item"], "id_owner", []))) {
                    // line 87
                    echo "                                    <div class=\"g-photo-statuses__item g-photo-statuses__item_place\">
                                        ";
                    // line 88
                    $module =                     null;
                    $helper =                     'spam';
                    $name =                     'mark_as_spam_block';
                    $params = array(["object_id" => $this->getAttribute(                    // line 89
($context["item"] ?? null), "id", []), "type_gid" => "media_object", "template" => "whitebutton"]                    ,                    );
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
                    // line 93
                    echo "                                    </div>
                                ";
                }
                // line 95
                echo "                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            // line 100
            echo "                </div>
            </div>
            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 103
            echo "                <div class=\"center\">
                    ";
            // line 104
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_media"            ,"media"            ,            );
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
            // line 105
            echo "                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        return array (  434 => 105,  413 => 104,  410 => 103,  395 => 100,  388 => 95,  384 => 93,  366 => 89,  362 => 88,  359 => 87,  356 => 86,  349 => 81,  347 => 80,  344 => 79,  326 => 75,  322 => 74,  316 => 71,  311 => 69,  307 => 67,  303 => 65,  282 => 64,  279 => 63,  277 => 62,  275 => 61,  271 => 59,  250 => 58,  247 => 57,  245 => 56,  232 => 48,  225 => 44,  220 => 41,  213 => 37,  206 => 36,  204 => 35,  179 => 32,  172 => 31,  170 => 30,  145 => 27,  138 => 26,  136 => 25,  131 => 22,  113 => 20,  112 => 18,  108 => 17,  103 => 16,  82 => 15,  75 => 14,  72 => 13,  69 => 12,  67 => 11,  63 => 9,  60 => 8,  57 => 7,  53 => 5,  51 => 4,  50 => 3,  48 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/list.twig");
    }
}
