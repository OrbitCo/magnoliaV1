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

/* comments_form.twig */
class __TwigTemplate_7104c425d9b40f057481fa0c8c6da88530313c9c5f41eceff96f64ad9150e8bc extends \Twig\Template
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
        ob_start(function () { return ''; });
        // line 2
        echo "    ";
        if ($this->getAttribute(($context["comments"] ?? null), "hidden", [])) {
            // line 3
            echo "        <div class=\"comments-display-block\">
            ";
            // line 4
            if (($this->getAttribute(($context["comments"] ?? null), "view", []) == "button")) {
                // line 5
                echo "                <div class=\"search-header\">
                    <div class=\"title\">";
                // line 6
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("comments"                ,"comments"                ,                );
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
                echo " (<span class=\"counter\">";
                echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                echo "</span>)</div>
                </div>
                <div class=\"commets-form\">
                  <input id=\"show-comments-form\" class=\"btn btn-primary\" type=\"button\" value=\"";
                // line 9
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_add_post_comment"                ,"comments"                ,                );
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
                echo "\" onclick=\"";
                ob_start(function () { return ''; });
                if ((($context["id_user"] ?? null) == 0)) {
                    echo "error_object.show_error_block('ajax_login_link', 'error');event.preventDefault();";
                } else {
                    // line 10
                    echo "                      \$('#comments_slider_";
                    echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                    echo "_";
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo "').toggleClass('hide');event.preventDefault();
                      ";
                }
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 11
                echo "\">
                </div>
            ";
            } elseif (($this->getAttribute(            // line 13
($context["comments"] ?? null), "view", []) == "link")) {
                // line 14
                echo "                <a href=\"javascript:void(0);\" onclick=\"";
                ob_start(function () { return ''; });
                // line 15
                echo "                        comments.loadComments(
                                '";
                // line 16
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "gid", []), "js");
                echo "',
                                '";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "id_obj", []), "js");
                echo "',
                                \$('#comments_";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "gid", []), "js");
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "id_obj", []), "js");
                echo "')
                                );
                        event.preventDefault();
                   ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 21
                echo "\">
                       <i class=\"far fa-comment\"></i>
                       ";
                // line 23
                if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                    // line 24
                    echo "                           <span class=\"counter\">";
                    echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                    echo "</span>
                       ";
                }
                // line 26
                echo "                   </a>
                   ";
            } else {
                // line 28
                echo "                       ";
                if ((($this->getAttribute(($context["comments"] ?? null), "show_form", []) || $this->getAttribute(($context["comments"] ?? null), "count_all", [])) ||  !$this->getAttribute(($context["comments"] ?? null), "calc_count", []))) {
                    // line 29
                    echo "                           <a class=\"like-btn-block\" href=\"javascript:void(0);\" onclick=\"";
                    ob_start(function () { return ''; });
                    // line 30
                    echo "                                   comments.loadComments(
                                           '";
                    // line 31
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "gid", []), "js");
                    echo "',
                                           '";
                    // line 32
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "id_obj", []), "js");
                    echo "',
                                           \$('#comments_";
                    // line 33
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "gid", []), "js");
                    echo "_";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "id_obj", []), "js");
                    echo "')
                                           );
                                   event.preventDefault();
                              ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 36
                    echo "\">
                                  <i class=\"far fa-comment\"></i>
                                  ";
                    // line 38
                    if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                        // line 39
                        echo "                                      <span class=\"counter\">";
                        echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                        echo "</span>
                                  ";
                    }
                    // line 41
                    echo "                              </a>
                              ";
                } else {
                    // line 43
                    echo "                                  <a class=\"like-btn-block\" href=\"javascript:void(0);\">
                                      <i class=\"far fa-comment\"></i>
                                      ";
                    // line 45
                    if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                        // line 46
                        echo "                                          <span class=\"counter\">";
                        echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                        echo "</span>
                                      ";
                    }
                    // line 48
                    echo "                                  </a>
                                  ";
                }
                // line 50
                echo "                                      ";
            }
            // line 51
            echo "                                      </div>
                                      ";
        } else {
            // line 53
            echo "                                          <div id=\"comments_form_cont_";
            echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
            echo "_";
            echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
            echo "\"
                                               class=\"form_wrapper comments-form-wrapper\" gid=\"";
            // line 54
            echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
            echo "\" id_obj=\"";
            echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
            echo "\">
                                              ";
            // line 55
            if (($this->getAttribute(($context["comments"] ?? null), "view", []) == "button")) {
                // line 56
                echo "                                                  <div class=\"search-header\">
                                                      <div class=\"title\">";
                // line 57
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("comments"                ,"comments"                ,                );
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
                echo " (<span class=\"counter\">";
                echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                echo "</span>)</div>
                                                  </div>
                                                  <div class=\"commets-form pb10\">
                                                      <input id=\"show-comments-form\" class=\"btn ";
                // line 60
                if ($this->getAttribute(($context["comments"] ?? null), "btn_view_class", [])) {
                    echo $this->getAttribute(($context["comments"] ?? null), "btn_view_class", []);
                } else {
                    echo "btn-primary";
                }
                echo "\" type=\"button\" value=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_add_post_comment"                ,"comments"                ,                );
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
                echo "\" onclick=\"
                                                             ";
                // line 61
                if ((($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []) != "user") &&  !$this->getAttribute(($context["comments"] ?? null), "show_form", []))) {
                    echo " error_object.show_error_block('ajax_login_link', 'error');event.preventDefault();";
                } else {
                    ob_start(function () { return ''; });
                    // line 62
                    echo "                                                                     \$('#comments_form_";
                    echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                    echo "_";
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo "').toggleClass('hide');
                                                                     event.preventDefault();
                                                             ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                }
                // line 64
                echo "\">
                                                  </div>
                                              ";
            } elseif (($this->getAttribute(            // line 66
($context["comments"] ?? null), "view", []) == "link")) {
                // line 67
                echo "                                                  <a href=\"javascript:void(0);\" onclick=\"";
                ob_start(function () { return ''; });
                // line 68
                echo "                                                          comments.loadComments(
                                                                  '";
                // line 69
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "gid", []), "js");
                echo "',
                                                                  '";
                // line 70
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "id_obj", []), "js");
                echo "',
                                                                  \$('#comments_";
                // line 71
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "gid", []), "js");
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["comments"] ?? null), "id_obj", []), "js");
                echo "')
                                                                  );
                                                          event.preventDefault();
                                                     ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 74
                echo "\">
                                                          ";
                // line 75
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("comments"                ,"comments"                ,                );
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
                // line 76
                echo "                                                          ";
                if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                    // line 77
                    echo "                                                              &nbsp;(<span class=\"counter\">";
                    echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                    echo "</span>)
                                                          ";
                }
                // line 79
                echo "                                                      </a>
                                                      ";
            } elseif (($this->getAttribute(            // line 80
($context["comments"] ?? null), "view", []) == "popup")) {
                // line 81
                echo "                                                          <div class=\"comments-display-block pb5 mt20\">
                                                              ";
                // line 82
                if (($this->getAttribute(($context["comments"] ?? null), "show_form", []) || $this->getAttribute(($context["comments"] ?? null), "count_all", []))) {
                    // line 83
                    echo "                                                                  <div class=\"title fleft\">";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("comments"                    ,"comments"                    ,                    );
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
                    echo "</div>
                                                                  <a class=\"like-btn-block\" href=\"javascript:void(0);\" onclick=\"";
                    // line 84
                    ob_start(function () { return ''; });
                    // line 85
                    echo "                                                                          \$('#comments_slider_";
                    echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                    echo "_";
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo "').toggleClass('hide');
                                                                          event.preventDefault();
                                                                     ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 87
                    echo "\">
                                                                         <i class=\"far fa-comment\"></i>
                                                                         ";
                    // line 89
                    if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                        // line 90
                        echo "                                                                             <span class=\"counter\">";
                        echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                        echo "</span>
                                                                         ";
                    }
                    // line 92
                    echo "                                                                     </a>
                                                                     ";
                } else {
                    // line 94
                    echo "                                                                         <div class=\"title fleft\">";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("comments"                    ,"comments"                    ,                    );
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
                    echo "</div>
                                                                         <a class=\"like-btn-block\" href=\"javascript:void(0);\">
                                                                             <i class=\"far fa-comment\"></i>
                                                                             ";
                    // line 97
                    if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                        // line 98
                        echo "                                                                                 <span class=\"counter\">";
                        echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                        echo "</span>
                                                                             ";
                    }
                    // line 100
                    echo "                                                                         </a>
                                                                         ";
                }
                // line 102
                echo "                                                                         </div>
                                                                         ";
            } else {
                // line 104
                echo "                                                                             <div class=\"comments-display-block\">
                                                                                 ";
                // line 105
                if (($this->getAttribute(($context["comments"] ?? null), "show_form", []) || $this->getAttribute(($context["comments"] ?? null), "count_all", []))) {
                    // line 106
                    echo "                                                                                     <a class=\"like-btn-block\" href=\"javascript:void(0);\" onclick=\"";
                    ob_start(function () { return ''; });
                    // line 107
                    echo "                                                                                             \$('#comments_slider_";
                    echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                    echo "_";
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo "').toggleClass('hide');
                                                                                             event.preventDefault();
                                                                                        ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 109
                    echo "\">
                                                                                            <i class=\"far fa-comment\"></i>
                                                                                            ";
                    // line 111
                    if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                        // line 112
                        echo "                                                                                                <span class=\"counter\">";
                        echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                        echo "</span>
                                                                                            ";
                    }
                    // line 114
                    echo "                                                                                        </a>
                                                                                        ";
                } else {
                    // line 116
                    echo "                                                                                            <a class=\"like-btn-block\" href=\"javascript:void(0);\">
                                                                                                <i class=\"far fa-comment\"></i>
                                                                                                ";
                    // line 118
                    if ($this->getAttribute(($context["comments"] ?? null), "calc_count", [])) {
                        // line 119
                        echo "                                                                                                    <span class=\"counter\">";
                        echo $this->getAttribute(($context["comments"] ?? null), "count_all", []);
                        echo "</span>
                                                                                                ";
                    }
                    // line 121
                    echo "                                                                                            </a>
                                                                                            ";
                }
                // line 123
                echo "                                                                                            </div>
                                                                                            ";
            }
            // line 125
            echo "
                                                                                                <div id=\"comments_slider_";
            // line 126
            echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
            echo "_";
            echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
            echo "\" class=\"comments_slider\">
                                                                                                    ";
            // line 127
            if ($this->getAttribute(($context["comments"] ?? null), "show_form", [])) {
                // line 128
                echo "                                                                                                        <div id=\"comments_form_";
                echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                echo "_";
                echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                echo "\"  ";
                if (($this->getAttribute(($context["comments"] ?? null), "view", []) == "button")) {
                    echo "class=\"hide\"";
                }
                echo ">
                                                                                                            <div class=\"edit_block post-form wide resize\">
                                                                                                                ";
                // line 130
                if (($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []) != "user")) {
                    // line 131
                    echo "                                                                                                                    <div class=\"b form-group hidden\">
                                                                                                                        <input class=\"form-control\" placeholder=\"";
                    // line 132
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_email"                    ,"users"                    ,""                    ,"button"                    ,                    );
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
                    echo "\" type=\"email\" value=\"\" name=\"email\" autocomplete=\"off\" />
                                                                                                                    </div>
                                                                                                                ";
                }
                // line 135
                echo "
                                                                                                                ";
                // line 136
                if (($this->getAttribute(($context["comments_type"] ?? null), "gid", []) == "wall_events")) {
                    // line 137
                    echo "                                                                                                                    <div class=\"form-input wall-comments-input\">
                                                                                                                        ";
                    // line 138
                    if (($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []) != "user")) {
                        // line 139
                        echo "                                                                                                                            <div class=\"input\">
                                                                                                                                <input type=\"text\" value=\"\" name=\"user_name\"
                                                                                                                                       placeholder=\"";
                        // line 141
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("your_name"                        ,"comments"                        ,""                        ,"button"                        ,                        );
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
                        echo "\" />
                                                                                                                            </div>
                                                                                                                        ";
                    }
                    // line 144
                    echo "                                                                                                                        <div class=\"text\">
                                                                                                                            <img class=\"wall-comment-block-img\" src=\"";
                    // line 145
                    echo ($context["user_img"] ?? null);
                    echo "\" />
                                                                                                                            <div style=\"margin-left: 40px;\">
                                                                                                                                <textarea style=\"width:100%;\" class=\"cmn-input-h\" maxcount=\"";
                    // line 147
                    echo $this->getAttribute($this->getAttribute(($context["comments_type"] ?? null), "settings", []), "char_count", []);
                    echo "\"
                                                                                                                                          placeholder=\"";
                    // line 148
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("add_comment"                    ,"comments"                    ,""                    ,"button"                    ,                    );
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
                                                                                                                                <div class=\"send-comment-btn-block hide\">
                                                                                                                                    <div class=\"char-counter fright\">
                                                                                                                                        <span class=\"char_counter\">
                                                                                                                                            ";
                    // line 152
                    echo $this->getAttribute($this->getAttribute(($context["comments_type"] ?? null), "settings", []), "char_count", []);
                    echo "
                                                                                                                                        </span>
                                                                                                                                    </div>
                                                                                                                                    <div>
                                                                                                                                        <input type=\"button\" class=\"btn btn-primary-inverted\" value=\"";
                    // line 156
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_send"                    ,"start"                    ,                    );
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
                                                                                                                                               onclick=\"";
                    // line 157
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("home_wall"                    ,"comment_send"                    ,                    );
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
                    echo "comments.addComment('";
                    echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                    echo "', '";
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo "');\" />
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <script>
                                                                                                                        \$(\"#comments_wall_events_";
                    // line 164
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo " textarea\").on('click', function (event) {
                                                                                                                            event.stopPropagation();
                                                                                                                            \$(\"#comments_wall_events_";
                    // line 166
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo " .send-comment-btn-block\").show();
                                                                                                                            \$(this).removeClass('cmn-input-h');
                                                                                                                        });
                                                                                                                        \$(\"html\").on('click', function () {
                                                                                                                            \$(\"#comments_wall_events_";
                    // line 170
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo " .send-comment-btn-block\").hide();
                                                                                                                            \$(\"#comments_wall_events_";
                    // line 171
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo " textarea\").addClass('cmn-input-h');
                                                                                                                        });
                                                                                                                    </script>
                                                                                                                ";
                } else {
                    // line 175
                    echo "                                                                                                                    <div>
                                                                                                                        <div class=\"form-input\">
                                                                                                                            ";
                    // line 177
                    if (($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []) != "user")) {
                        // line 178
                        echo "                                                                                                                                <div class=\"input form-group\">
                                                                                                                                    <input class=\"form-control\" type=\"text\" value=\"\" name=\"user_name\"
                                                                                                                                           placeholder=\"";
                        // line 180
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("your_name"                        ,"comments"                        ,""                        ,"button"                        ,                        );
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
                        echo "\" />
                                                                                                                                </div>
                                                                                                                            ";
                    }
                    // line 183
                    echo "                                                                                                                            <div class=\"text form-group\">
                                                                                                                                <textarea class=\"form-control\" maxcount=\"";
                    // line 184
                    echo $this->getAttribute($this->getAttribute(($context["comments_type"] ?? null), "settings", []), "char_count", []);
                    echo "\"
                                                                                                                                          placeholder=\"";
                    // line 185
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("add_comment"                    ,"comments"                    ,""                    ,"button"                    ,                    );
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
                                                                                                                            </div>
                                                                                                                            <div class=\"char-counter fright\">
                                                                                                                                <span class=\"char_counter\">
                                                                                                                                    ";
                    // line 189
                    echo $this->getAttribute($this->getAttribute(($context["comments_type"] ?? null), "settings", []), "char_count", []);
                    echo "
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                            <div class=\"send-comment-btn-block\">
                                                                                                                                <input type=\"button\" class=\"btn ";
                    // line 193
                    if ($this->getAttribute(($context["comments"] ?? null), "btn_send_class", [])) {
                        echo $this->getAttribute(($context["comments"] ?? null), "btn_send_class", []);
                    } else {
                        echo "btn-primary-inverted";
                    }
                    echo "\" value=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_send"                    ,"start"                    ,                    );
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
                                                                                                                                       onclick=\"comments.addComment('";
                    // line 194
                    echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                    echo "', '";
                    echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                    echo "');\" />
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                ";
                }
                // line 199
                echo "
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    ";
            }
            // line 203
            echo "
                                                                                                    <div id=\"comments_cont_";
            // line 204
            echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
            echo "_";
            echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
            echo "\" class=\"comments_wrapper\">
                                                                                                        ";
            // line 205
            $this->loadTemplate("comments_block.twig", "comments_form.twig", 205)->display($context);
            // line 206
            echo "                                                                                                    </div>
                                                                                                    ";
            // line 207
            if (($this->getAttribute(($context["comments"] ?? null), "bd_min_id", []) != $this->getAttribute(($context["comments"] ?? null), "min_id", []))) {
                // line 208
                echo "                                                                                                        <div class=\"more_button mt10\">
                                                                                                            <input class=\"btn btn-primary\" type=\"button\" value=\"";
                // line 209
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("show_more"                ,"comments"                ,                );
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
                                                                                                                   onclick=\"comments.loadComments('";
                // line 210
                echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
                echo "', '";
                echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
                echo "');\" />
                                                                                                        </div>
                                                                                                    ";
            }
            // line 213
            echo "                                                                                                </div>
                                                                                            </div>
                                                                                            ";
        }
        // line 216
        echo "                                                                                                ";
        $context["comment_content"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 217
        echo "
                                                                                                    ";
        // line 218
        if ( !($context["ajax"] ?? null)) {
            // line 219
            echo "                                                                                                        <div class=\"comments\" id=\"comments_";
            echo $this->getAttribute(($context["comments"] ?? null), "gid", []);
            echo "_";
            echo $this->getAttribute(($context["comments"] ?? null), "id_obj", []);
            echo "\">
                                                                                                            <script>
                                                                                                                \$(function () {
                                                                                                                    loadScripts(
                                                                                                                            \"";
            // line 223
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("comments"            ,"comments.js"            ,"path"            ,            );
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
                                                                                                                                comments = new Comments({
                                                                                                                                    siteUrl: site_url,
                                                                                                                                    lng: \$.parseJSON('";
            // line 227
            echo twig_escape_filter($this->env, ($context["js_lng"] ?? null), "js");
            echo "'),
                                                                                                                ";
            // line 228
            if (($this->getAttribute(($context["comments_type"] ?? null), "gid", []) == "wall_events")) {
                echo "order_by: 'asc',
                                                                                                                                        append_comment: 'true',";
            }
            // line 230
            echo "                                                                                                                                    });
                                                                                                                                },
                                                                                                                                'comments',
                                                                                                                                {async: false, cache: false}
                                                                                                                        );
                                                                                                                    });
                                                                                                                </script>

                                                                                                                ";
            // line 238
            echo ($context["comment_content"] ?? null);
            echo "
                                                                                                            </div>
                                                                                                        ";
        } else {
            // line 241
            echo "                                                                                                            ";
            echo ($context["comment_content"] ?? null);
            echo "
                                                                                                        ";
        }
        // line 244
        echo "  ";
        if (($context["show_login"] ?? null)) {
            // line 245
            echo "    <script type=\"text/javascript\">
      \$(function(){
          \$('.comments .like-btn-block').click(function(e){
            e.preventDefault();
            var login = new loadingContent({loadBlockWidth: '500px', closeBtnClass: 'w', loadBlockTopType: 'bottom', loadBlockTopPoint: 20, blockBody: true, showAfterImagesLoad: false});
            \$.post(site_url + \"users/ajax_login_form\", function( data ) {
               login.unsetLoadedBlock();
               login.show_load_block(data);
            });
          });
      });
    </script>
  ";
        }
    }

    public function getTemplateName()
    {
        return "comments_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  991 => 245,  988 => 244,  982 => 241,  976 => 238,  966 => 230,  961 => 228,  957 => 227,  931 => 223,  921 => 219,  919 => 218,  916 => 217,  913 => 216,  908 => 213,  900 => 210,  877 => 209,  874 => 208,  872 => 207,  869 => 206,  867 => 205,  861 => 204,  858 => 203,  852 => 199,  842 => 194,  813 => 193,  806 => 189,  780 => 185,  776 => 184,  773 => 183,  748 => 180,  744 => 178,  742 => 177,  738 => 175,  731 => 171,  727 => 170,  720 => 166,  715 => 164,  682 => 157,  659 => 156,  652 => 152,  626 => 148,  622 => 147,  617 => 145,  614 => 144,  589 => 141,  585 => 139,  583 => 138,  580 => 137,  578 => 136,  575 => 135,  550 => 132,  547 => 131,  545 => 130,  533 => 128,  531 => 127,  525 => 126,  522 => 125,  518 => 123,  514 => 121,  508 => 119,  506 => 118,  502 => 116,  498 => 114,  492 => 112,  490 => 111,  486 => 109,  477 => 107,  474 => 106,  472 => 105,  469 => 104,  465 => 102,  461 => 100,  455 => 98,  453 => 97,  427 => 94,  423 => 92,  417 => 90,  415 => 89,  411 => 87,  402 => 85,  400 => 84,  376 => 83,  374 => 82,  371 => 81,  369 => 80,  366 => 79,  360 => 77,  357 => 76,  336 => 75,  333 => 74,  324 => 71,  320 => 70,  316 => 69,  313 => 68,  310 => 67,  308 => 66,  304 => 64,  294 => 62,  289 => 61,  260 => 60,  233 => 57,  230 => 56,  228 => 55,  222 => 54,  215 => 53,  211 => 51,  208 => 50,  204 => 48,  198 => 46,  196 => 45,  192 => 43,  188 => 41,  182 => 39,  180 => 38,  176 => 36,  167 => 33,  163 => 32,  159 => 31,  156 => 30,  153 => 29,  150 => 28,  146 => 26,  140 => 24,  138 => 23,  134 => 21,  125 => 18,  121 => 17,  117 => 16,  114 => 15,  111 => 14,  109 => 13,  105 => 11,  96 => 10,  70 => 9,  43 => 6,  40 => 5,  38 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "comments_form.twig", "/home/mliadov/public_html/application/modules/comments/views/flatty/comments_form.twig");
    }
}
