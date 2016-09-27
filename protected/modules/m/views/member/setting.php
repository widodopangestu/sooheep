<div class="pages">
    <div class="page no-toolbar" data-page="settings">
        <div class="page-content ">
            <div class="page-content">

                <?php
                $registerForm = new RegisterForm();
                $form2 = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'login-form2',
                    'type' => 'horizontal',
                    'action' => CController::createUrl('member/setting')
                ));
                ?>

                <div class="list-block">
                <?php echo $form2->errorSummary($formReg); ?>
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">First Name</div>
                                    <div class="item-input">
                                        <?php echo $form2->textField($formReg, 'firstname', array('placeholder' => 'First Name')) ?>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Last Name</div>
                                    <div class="item-input">
                                        <?php echo $form2->textField($formReg, 'lastname', array('placeholder' => 'Last Name')) ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Select -->
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Gender</div>
                                    <div class="item-input">
                                        <?php echo $form2->dropDownList($formReg, 'gender', $registerForm->getDataGender()) ?>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Birth Date</div>
                                    <div class="item-input">
                                        <?php echo $form2->dropDownList($formReg, 'dayOf', $registerForm->getDate()) ?>
                                        <?php echo $form2->dropDownList($formReg, 'monthOf', $registerForm->getMonth()) ?>
                                        <?php echo $form2->dropDownList($formReg, 'yearOf', $registerForm->getYear(10)) ?>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Select -->
                        <li>
                            <a href="#" class="item-link smart-select" data-searchbar="true" data-searchbar-placeholder="Search Country" data-open-in="popup">
                                <?php
                                echo $form2->dropDownList($formReg, 'id_country', $registerForm->getCountry(), array(
                                    'class' => "form-control form-effect ",
                                    'empty' => 'Chose Country',
                                    //'onchange' => 'alert("test")',
                                    'ajax' => array(
                                        'type' => 'POST', //request type
                                        'url' => CController::createUrl('/new/getcity2'), //url to call.
                                        'update' => "#Profile_id_city", //selector to update
                                        'beforeSend' => 'function(){
													      myApp.showPreloader();
													}',
                                        'complete' => 'function(){
													      myApp.hidePreloader();
													}'
                                    )
                                ));
                                ?>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">Country</div>
                                        <div class="item-after">
                                            Chose Country

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Select -->
                        <li>
                            <a href="#" class="item-link smart-select" data-searchbar="true" data-searchbar-placeholder="Search Country" data-open-in="popup" data-virtual-list="true" data-virtual-list-height="55">
                                <?php
                                if (isset($formReg->id_city) && $formReg->id_city != null) {
                                    $dataCity = CHtml::listData(MasterCity::model()->findAll(array(
                                                        'condition' => 'city_country_id = :parent_id',
                                                        'params' => array(':parent_id' => intval($formReg->id_country))
                                                    )), 'city_id', 'city_name');
                                } else
                                    $dataCity = array();

                                echo $form2->dropDownList($formReg, 'id_city', $dataCity, array(
                                    'class' => "form-control form-effect ",
                                    'empty' => 'Chose City',
                                ))
                                ?>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">City</div>
                                        <div class="item-after">
                                            Chose City
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="input-submit pull-right">
                                        <?php echo CHtml::htmlButton('Save', array('type' => 'submit', 'class' => 'button button-big js-form-submit button-fill button-primary')) ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>