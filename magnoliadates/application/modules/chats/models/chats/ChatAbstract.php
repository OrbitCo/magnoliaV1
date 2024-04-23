<?php

declare(strict_types=1);

namespace Pg\modules\chats\models\chats;

abstract class ChatAbstract extends \Model
{
    protected $ci;

    /**
     * Id
     *
     * @int type
     */
    protected $_id;

    /**
     * Gid
     *
     * @var string
     */
    protected $_gid;

    /**
     * Name
     *
     * @var string
     */
    protected $_name;

    /**
     * Installed flag
     *
     * @var bool
     */
    protected $_installed;

    /**
     * Active flag
     *
     * @var bool
     */
    protected $_active;

    /**
     * Vendor url
     * string type
     */
    protected $_vendor_url;

    /**
     * Chat directory
     *
     * @var string
     */
    protected $_dir = '';

    /**
     * Chat real directory
     *
     * @var string
     */
    protected $_rdir = '';

    /**
     * Chat activities
     *
     * @var array
     */
    protected $_activities;

    /**
     * Settings
     * array type
     */
    protected $_settings;

    abstract public function userPage();

    abstract public function includeBlock();

    abstract public function adminPage();

    abstract public function installPage();

    abstract public function validateSettings();

    public function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
    }

    /**
     * Check whether chat has required files. Should be redefined in subclasses,
     * otherwise allways returns true
     *
     * @return boolean
     */
    public function hasFiles()
    {
        return is_dir(SITE_PHYSICAL_PATH . $this->Chats_model->path . $this->get_gid());
    }

    public function getDir()
    {
        return (string) $this->_dir;
    }

    /**
     * Get chat id
     *
     * @return int
     */
    public function getId()
    {
        return (int) $this->_id;
    }

    /**
     * Set chat id
     *
     * @param int $id
     *
     * @return \Chat_abstract
     */
    public function setId($id)
    {
        $this->_id = (int) $id;

        return $this;
    }

    /**
     * Get chat gid
     *
     * @return string
     */
    public function getGid()
    {
        return (string) $this->_gid;
    }

    /**
     * Set chat gid
     *
     * @param string $gid
     *
     * @return \Chat_abstract
     */
    public function setGid($gid)
    {
        $this->_gid = (string) $gid;

        return $this;
    }

    /**
     * Get chat name
     *
     * @return string
     */
    public function getName()
    {
        return (string) $this->_name;
    }

    /**
     * Get chat installed flag
     *
     * @return bool
     */
    public function getInstalled()
    {
        return (bool) $this->_installed;
    }

    /**
     * Set chat installed flag
     *
     * @param bool $installed
     *
     * @return \Chat_abstract
     */
    public function setInstalled($installed = true)
    {
        $this->_installed = (bool) $installed;

        return $this;
    }

    /**
     * Get chat activity flag
     *
     * @return bool
     */
    public function getActive()
    {
        return (bool) $this->_active;
    }

    /**
     * Set chat activity flag
     *
     * @param type $active
     *
     * @return \Chat_abstract
     */
    public function setActive($active = true)
    {
        $this->_active = (bool) $active;

        return $this;
    }

    /**
     * Get activities
     *
     * @return array
     */
    public function getActivities($for_db = false)
    {
        if ($for_db) {
            return implode(',', $this->_activities);
        } else {
            return $this->_activities;
        }
    }

    /**
     * Set activities
     *
     * @param mixed $activities
     *
     * @return \Chat_abstract
     */
    public function setActivities($activities)
    {
        if (is_string($activities)) {
            $this->set_activities(explode(',', $activities));
        } elseif (is_array($activities)) {
            foreach ($activities as $key => $activity) {
                if (!in_array($activity, $this->ci->Chats_model->activities)) {
                    log_message('error', 'Wrong activity (' . gettype($activity) . ')');
                    unset($activities[$key]);
                }
            }
            $this->_activities = $activities;
        } else {
            log_message('error', 'Wrong activities type (' . gettype($activities) . ')');
        }

        return $this;
    }

    /**
     * Get chat settings.
     *
     * @param mixed $param
     *                     <b>null</b> — all settings<br>
     *                     <b>string</b> — value by key<br>
     *                     <b>true</b> — all settings in the form of serialized array
     *
     * @return array
     */
    public function getSettings($param = null)
    {
        if ($param === true) {
            return serialize($this->_settings);
        } elseif ($param) {
            if (isset($this->_settings['param'])) {
                return $this->_settings['param'];
            } else {
                return false;
            }
        } else {
            return $this->_settings;
        }
    }

    /**
     * Set chat settings.
     *
     * @param mixed $settings array or serialized array (will be unserialized before saving).
     *
     * @return \Chat_abstract
     */
    public function setSettings($settings)
    {
        if (is_array($settings)) {
            $this->_settings = array_replace_recursive($this->_settings, $settings);
        } elseif ('b:0;' !== $settings && false !== ($unserialized = @unserialize($settings))) {
            return $this->set_settings($unserialized);
        } else {
            log_message('error', 'Wrong settings type (' . gettype($settings) . ')');
        }

        return $this;
    }

    /**
     * Set object properties from array.
     *
     * @param array $data
     *
     * @return \Chat_abstract
     */
    public function set($data)
    {
        if (!is_array($data)) {
            log_message('error', 'Wrong parameter');
        }
        foreach ($data as $key => $val) {
            $setter = 'set_' . $key;
            if (method_exists($this, $setter)) {
                $this->{$setter}($val);
            }
            // TODO: убрать после приведения к PSR
            else {
                $chunks = explode('_', $key);
                $setter = 'set';
                foreach ($chunks as $chunk) {
                    $setter .= ucfirst($chunk);
                }
                if (method_exists($this, $setter)) {
                    $this->{$setter}($val);
                }
            }
        }

        return $this;
    }

    /**
     * Get tamplate name
     *
     * @param string $page
     *
     * @return string
     */
    public function getTplName($page = '')
    {
        $tpl = $this->_gid;
        if ($page) {
            $tpl .= '_' . $page;
        }

        return $tpl;
    }

    /**
     * Get chat propertyes in the form of array
     *
     * @param bool $for_db If true, will return only properties that stores in database
     *
     * @return array
     */
    final public function asArray($for_db = false)
    {
        $data = [
            'id'         => $this->get_id(),
            'gid'        => $this->get_gid(),
            'active'     => $this->get_active(),
            'installed'  => $this->get_installed(),
            'activities' => $this->get_activities($for_db),
            'settings'   => $this->get_settings($for_db),
        ];
        if (!$for_db) {
            $data += [
                'name'      => $this->get_name(),
                'has_files' => $this->has_files(),
                'dir'       => $this->get_dir(),
            ];
        } elseif (0 === $data['id']) {
            unset($data['id']);
        }

        return $data;
    }

    /**
     * Save current state to database
     *
     * @return \Chat_abstract
     */
    public function save()
    {
        $data = $this->as_array(true);

        if ($this->get_id()) {
            $this->ci->db->where('id', $data['id']);
            $this->ci->db->update(CHATS_TABLE, $data);
        }

        return $this;
    }

    public function __call($name, $args)
    {
        $methods = [
            'user_page' => 'userPage',
            'include_block' => 'includeBlock',
            'admin_page' => 'adminPage',
            'install_page' => 'installPage',
            'validate_settings' => 'validateSettings',
            'as_array' => 'asArray',
            'get_active' => 'getActive',
            'get_activities' => 'getActivities',
            'get_dir' => 'getDir',
            'get_gid' => 'getGid',
            'get_id' => 'getId',
            'get_installed' => 'getInstalled',
            'get_name' => 'getName',
            'get_settings' => 'getSettings',
            'get_tpl_name' => 'getTplName',
            'has_files' => 'hasFiles',
            'set_active' => 'setActive',
            'set_activities' => 'setActivities',
            'set_gid' => 'setGid',
            'set_id' => 'setId',
            'set_installed' => 'setInstalled',
            'set_settings' => 'setSettings',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
