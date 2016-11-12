<?php

/**
 * Class Am_Plugin_EntsReadonlyAddress
 */
class Am_Plugin_EntsReadonlyAddress extends Am_Plugin
{
    const PLUGIN_STATUS = self::STATUS_PRODUCTION;
    const PLUGIN_COMM = self::COMM_FREE;
    const PLUGIN_REVISION = "1.0.0";

    // This is a shell plugin to load the form brick below.
}

class Am_Form_Brick_ReadonlyAddress extends Am_Form_Brick
{

    protected $labels = array(
        "Street",
        "City",
        "Country",
        "Province",
        "Postal Code",
        "Address Information"
    );

    public function __construct($id = null, array $config = null)
    {
        parent::__construct($id, $config);
        $this->name = "Readonly Address Information";
    }

    public function insertBrick(HTML_QuickForm2_Container $form)
    {
        $user = Am_Di::getInstance()->user;
        $fs = $form->addFieldSet()->setLabel($this->___("Address Information"));

        $changeMessage = $this->getConfig("change_message", "");
        if (strlen(trim($changeMessage)) > 0)
            $fs->addHtml("alert_message")->setHtml($changeMessage);

        $fs->addText("address_street", array("value" => $user->street, "disabled" => true, "class" => "el-wide"))->setLabel($this->___("Street"));
        $fs->addText("address_city", array("value" => $user->city, "disabled" => true, "class" => "el-wide"))->setLabel($this->___("City"));
        $fs->addText("address_country", array("value" => $user->country, "disabled" => true))->setLabel($this->___("Country"));
        $fs->addText("address_province", array("value" => $user->state, "disabled" => true))->setLabel($this->___("Province"));
        $fs->addText("address_postalcode", array("value" => $user->zip, "disabled" => true))->setLabel($this->___("Postal Code"));
    }

    function initConfigForm(Am_Form $form)
    {
        $form->addTextArea("change_message", array("style" => "height: 70px; width: 70%;"))->setLabel("HTML Change Message\nempty - no message shown.");
    }
}