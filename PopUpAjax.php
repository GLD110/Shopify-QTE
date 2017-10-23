<?php
header('Access-Control-Allow-Origin: *');
$fullUrl =  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$endPointUrl = explode('/PopUpAjax.php' , $fullUrl);
$appUrl = $endPointUrl[0];
include 'include/DBConnection.php';
$getIp = $db->query("SELECT count FROM tbl_ip_settings WHERE store_name='" . $_REQUEST['storeName'] . "' AND ip='" . $_REQUEST['ip'] . "' AND time >= CURDATE() - INTERVAL 1 DAY");

if ($getIp->num_rows > 0) {
    $getIp = $getIp->fetch_assoc();

    $count = $getIp['count'] + 1;
    $db->query("UPDATE tbl_ip_settings SET count='" . $count . "' WHERE ip='" . $_REQUEST['ip'] . "' AND store_name='" . $_REQUEST['storeName'] . "'");
} else {
    $db->query("INSERT INTO tbl_ip_settings(`ip`,`count`,`store_name`,`time`) VALUES('" . $_REQUEST['ip'] . "','1','" . $_REQUEST['storeName'] . "','" . date("Y-m-d") . "')");
}
//$fetch = $db->query("SELECT qd.*,gs.quizid,gs.ip_setting from tbl_new_quiz_details as qd INNER JOIN tbl_global_setting as gs WHERE gs.quiz_percentage=(select max(subp.quiz_percentage) from tbl_global_setting as subp WHERE subp.status=1 AND qd.status=1) AND qd.id=gs.quizid AND gs.store_name='".$_REQUEST['storeName']."' ORDER BY RAND() LIMIT 1");
//$sql_query = "SELECT qd.*,gs.quizid,gs.ip_setting from tbl_new_quiz_details as qd INNER JOIN tbl_global_setting as gs WHERE gs.store_name='dre1982.myshopify.com' ORDER BY RAND() LIMIT 1";
//echo "SELECT qd.*,gs.quizid,gs.ip_setting from tbl_new_quiz_details as qd INNER JOIN tbl_global_setting as gs WHERE gs.quiz_percentage=(select max(subp.quiz_percentage) from tbl_global_setting as subp WHERE subp.status=1 AND qd.status=1 AND gs.store_name='".$_REQUEST['storeName']."') AND gs.store_name='".$_REQUEST['storeName']."' ORDER BY RAND() LIMIT 1";
$fetch = $db->query("SELECT qd.*,gs.quizid,gs.ip_setting from tbl_new_quiz_details as qd INNER JOIN tbl_global_setting as gs WHERE gs.quiz_percentage=(select max(subp.quiz_percentage) from tbl_global_setting as subp WHERE subp.status=1 AND qd.status=1 AND subp.store_name='" . $_REQUEST['storeName'] . "') AND gs.store_name='" . $_REQUEST['storeName'] . "' ORDER BY RAND() LIMIT 1");
//$fetch = $db->query($sql_query);

$Data = $fetch->fetch_assoc();

$excludepage = json_decode($Data['excludepage'], true);

if ($Data && $getIp['count'] <= $Data['ip_setting']) {

    if (!in_array($_REQUEST['page'], $excludepage)) {
        ?>
        <style>
            .modal-dialog {
                margin-top: 5%;
                <?php
                if ($Data['quizstyle'] == 'corner') {
                    echo "width: 25%;";
                    echo "right: 6px;";
                    echo "bottom: 0px;";
                    echo "position: fixed;";
                }
                ?>
            }
            .modal-content .modal-body { padding: 15px 0px; }
            .mainpagetext {
                background: <?php echo $Data['mainPageTextBg']; ?>;
                color: <?php echo $Data['mainPageTextFc']; ?>; 
            }

            .modal-body.mainPageBGImage{
                <?php
                if ($Data['mainPageBGImage'] == '') {
                    echo "background: " . $Data['mainPageBGColor'];
                } else {
                    echo "background: url('https://" . $appUrl . "/nimg/" . $Data['mainPageBGImage'] . "');";
                    echo "background-repeat: no-repeat;";
                    echo "background-size:cover;";
                }
                ?>
            }


            .modal-body.secondBGImage{
                <?php
                if ($Data['secondBGImage'] == '') {
                    echo "background: " . $Data['secondBGColor'];
                } else {
                    echo "background: url('https://" . $appUrl . "/nimg/" . $Data['secondBGImage'] . "');";
                    echo "background-repeat: no-repeat;";
                    echo "background-size:cover;";
                }
                ?>
            }
            .imageSize {
                <?php
                if ($Data['quizstyle'] == 'corner') {
                    echo "width: 30%;";
                } else {
                    echo "max-width: 100%; object-fit: cover;";
                }
                ?>
            }
            .mainPageDesc {
                background: <?php echo $Data['mainPageDescBg']; ?>;
                color: <?php echo $Data['mainPageDescFc']; ?>; 
            }
            .divPadding {
                padding: 9px;
            }
            .divPadding .btn {
                margin-bottom: 10px;
                min-width: 200px;
                padding: 6px 20px;
            }
            .mainPageBothButton,.mainPageBothButton:hover,.mainPageBothButton:focus {
                background: <?php echo $Data['mainPageButtonColor']; ?>;
                color: <?php echo $Data['mainPageButtonFontColor']; ?>; 
            }
            .mainPageThankYou {
                background: <?php echo $Data['ThankyouDescBg']; ?>;
                color: <?php echo $Data['ThankyouDescFc']; ?>; 
            }
            .secondpagetext {
                background: <?php echo $Data['secondPageTextBg']; ?>;
                color: <?php echo $Data['secondPageTextFc']; ?>; 
            }
            .secondpagedescription {
                background: <?php echo $Data['secondPageDescBg']; ?>;
                color: <?php echo $Data['secondPageDescFc']; ?>; 
            }
            .secondBothButton, .secondBothButton:hover,.secondBothButton:focus {
                background: <?php echo $Data['secondPageButtonColor']; ?>;
                color: <?php echo $Data['secondPageButtonFontColor']; ?>; 
            }
            .SecondThankYou {
                background: <?php echo $Data['SecondThankyouDescBg']; ?>;
                color: <?php echo $Data['SecondThankyouDescFc']; ?>; 
            }
            .sec-OptText {
                background: <?php echo $Data['optBg']; ?>;
                color: <?php echo $Data['optFc']; ?>; 
            }
            .main-OptText {
                background: <?php echo $Data['mainoptBg']; ?>;
                color: <?php echo $Data['mainoptFc']; ?>; 
            }
        </style>
        <link rel="stylesheet" type="text/css" href="https://<?php echo $appUrl; ?>/include/css/style.css">
        <?php if ($Data['quizstyle'] == 'exitintent') {
            $btnId = '';
        } else {
            $btnId = 'myPopButton';
        } ?>
        <button id="<?php echo $btnId; ?>" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="display: none;">Open Modal</button>
        
        <!-- pop up -->
        <div id="myModal" class="modal fade exit-modal" role="dialog">
            <div class="modal-dialog" style="margin-top: 5%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body mainPageBGImage">
                        <!-- Main page -->
                        <div class="MainPagePop">
                            <div class="text-center">
                                <div class="mainpagetext <?php echo $Data['mainPageTextFs'] . " " . $Data['mainPageTextFw'] . " " . $Data['mainPageTextFt']; ?>">
                                    <?php echo $Data['mainpagetext']; ?>
                                </div>
        <?php if ($Data['mainpageimage'] != '') { ?>
                                    <div class="divPadding">
                                        <img src="https://<?php echo $appUrl; ?>/nimg/<?php echo $Data['mainpageimage']; ?>" class="imageSize">
                                    </div>
        <?php } ?>
                                <div class="mainPageDesc <?php echo $Data['mainPageDescFs'] . " " . $Data['mainPageDescFw'] . " " . $Data['mainPageDescFt']; ?>">
                                        <?php echo $Data['mainPageDesc']; ?>
                                </div>
                                <div class="divPadding">
                                    <button class="LBtn btn btn-default mainPageBothButton <?php echo $Data['mainPagebuttonFs'] . " " . $Data['mainPagebuttonFw'] . " " . $Data['mainPagebuttonFt']; ?>">
        <?php echo $Data['mainPageLButton']; ?>
                                    </button>
                                    <button class="RBtn btn btn-default mainPageBothButton <?php echo $Data['mainPagebuttonFs'] . " " . $Data['mainPagebuttonFw'] . " " . $Data['mainPagebuttonFt']; ?>">
        <?php echo $Data['mainPageRButton']; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Main page -->
                        <!-- thankyou page -->
                        <div class="mainPageTY" style="display: none;">
                            <div class="text-center">
                                <div class="mainPageThankYou <?php echo $Data['ThankyouDescFs'] . " " . $Data['ThankyouDescFw'] . " " . $Data['ThankyouDescFt']; ?>">
        <?php echo $Data['mainPageThankYou']; ?>
                                </div>
                                <div class="divPadding">
                                    <button data-dismiss="modal" class="btn btn-default mainPageBothButton <?php echo $Data['mainPagebuttonFs'] . " " . $Data['mainPagebuttonFw'] . " " . $Data['mainPagebuttonFt']; ?>">Close</button>
                                </div>
                            </div>
                        </div>
                        <!-- thankyou page-->

                        <!--Second chance -->
                        <div class="secondChance" style="display: none;">
                            <div class="text-center">
                                <div class="secondpagetext <?php echo $Data['secondPageTextFs'] . " " . $Data['secondPageTextFw'] . " " . $Data['secondPageTextFt']; ?>">
                                    <?php echo $Data['secondpagetext']; ?>
                                </div>
        <?php if ($Data['mainpageimage'] != '') { ?>
                                    <div class="divPadding">
                                        <img src="https://<?php echo $appUrl; ?>/nimg/<?php echo $Data['secondpageimage']; ?>" class="imageSize">
                                    </div>
        <?php } ?>
                                <div class="secondpagedescription <?php echo $Data['secondPageDescFs'] . " " . $Data['secondPageDescFw'] . " " . $Data['secondPageDescFt']; ?>">
                                        <?php echo $Data['secondpagedescription']; ?>
                                </div>
                                <div class="divPadding">
                                    <button class="LBtn btn btn-default secondBothButton <?php echo $Data['secondPagebuttonFs'] . " " . $Data['secondPagebuttonFw'] . " " . $Data['secondPagebuttonFt']; ?>">
        <?php echo $Data['secondPageLButton']; ?>
                                    </button>
                                    <button class="RBtn btn btn-default secondBothButton <?php echo $Data['secondPagebuttonFs'] . " " . $Data['secondPagebuttonFw'] . " " . $Data['secondPagebuttonFt']; ?>">
        <?php echo $Data['secondPageRButton']; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--Second chance -- >
                        <!--Second thankyou page -->
                        <div class="SecondTY" style="display: none;">
                            <div class="text-center">
                                <div class="SecondThankYou <?php echo $Data['SecondThankyouDescFs'] . " " . $Data['SecondThankyouDescFw'] . " " . $Data['SecondThankyouDescFt']; ?>">
        <?php echo $Data['SecondThankyoutext']; ?>
                                </div>
                                <div class="divPadding">
                                    <button class="btn btn-default mainPageBothButton <?php echo $Data['SecondThankyouDescFs'] . " " . $Data['SecondThankyouDescFw'] . " " . $Data['SecondThankyouDescFt']; ?>" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                        <!--Second thankyou page-->

                        <!--Opt page text -->
                        <div class="Opt-Code" style="display: none;">
                            <div class="text-center">
                                <div class="sec-OptText <?php echo $Data['optFs'] . " " . $Data['optFw'] . " " . $Data['optFt']; ?>" style="display: none;">
        <?php echo $Data['optEmail']; ?>
                                </div>
                                <div class="main-OptText <?php echo $Data['mainoptFs'] . " " . $Data['mainoptFw'] . " " . $Data['mainoptFt']; ?>" style="display: none;">
        <?php echo $Data['mainoptEmail']; ?>
                                </div>
                                <div class="col-sm-6 col-sm-offset-3 divPadding">
                                    <input type="text" id="name" value="" placeholder="Enter Your name">
                                </div>
                                <div class="col-sm-6 col-sm-offset-3 divPadding">
                                    <input type="text" class="form-control" id="email" name="email" value="" placeholder="Enter Your Email">
                                    <input type="hidden" id="listname" value="<?php echo $Data['listname']; ?>">
                                    <input type="hidden" id="apiname" value="<?php echo $Data['apiname']; ?>">
                                    <div id="email-error" style="color: red;"></div>
                                </div>
                                <div class="divPadding">
                                    <button class="btn btn-default mainPageBothButton">
                                        Submit
                                    </button>
                                </div>
                                <!-- <div class="">
                                        <button class="btn btn-default mainPageBothButton <?php echo $Data['mainPagebuttonFs'] . " " . $Data['mainPagebuttonFw'] . " " . $Data['mainPagebuttonFt']; ?>">Close</button>
                                </div> -->
                            </div>
                        </div>
                        <!--Opt page text-->
                    </div>
                </div>
                <!-- Modal content-->
            </div>
        </div>
        <!-- pop up -->
        <script type="text/javascript">
            /**
             * Exit modal 2.0
             */
            (function () {
                
                var guid = 0;

                //constructor
                var exitModalObj = function (element, options) {
                    this.guid = guid++;
                    this.settings = $.extend({}, exitModalInterface.defaults, options);
                    this.$element = $(element);
                    this.showCounter = 0;
                    this.eventPrefix = '.exitModal' + this.guid;
                    this.modalShowEvent = 'show.bs.modal' + this.eventPrefix;
                    this.modalShownEvent = 'shown.bs.modal' + this.eventPrefix;
                    this.modalHideEvent = 'hide.bs.modal' + this.eventPrefix;
                    this.modalHiddenEvent = 'hidden.bs.modal' + this.eventPrefix;
                }

                exitModalObj.prototype = {
                    init: function () {
                        var plugin = this;
                        plugin.$element.modal({
                            backdrop: plugin.settings.modalBackdrop,
                            keyboard: plugin.settings.modalKeyboard,
                            show: false
                        });
                        plugin.$element.on(plugin.modalShowEvent, function (e) {
                            plugin.showCounter++;
                            plugin.mouseOutEventUnbind();
                            plugin.settings.callbackOnModalShow.call(plugin);
                        });
                        plugin.$element.on(plugin.modalShownEvent, function (e) {
                            plugin.settings.callbackOnModalShown.call(plugin);
                        });
                        plugin.$element.on(plugin.modalHideEvent, function (e) {
                            plugin.settings.callbackOnModalHide.call(plugin);
                        });
                        plugin.$element.on(plugin.modalHiddenEvent, function (e) {
                            if (plugin.settings.numberToShown) {
                                if (plugin.showCounter < plugin.settings.numberToShown) {
                                    plugin.mouseOutEventBind();
                                }
                            } else {
                                plugin.mouseOutEventBind();
                            }
                            plugin.settings.callbackOnModalHidden.call(plugin);
                        });
                        plugin.mouseOutEventBind();
                    },
                    mouseOutEventBind: function () {
                        var plugin = this;
                        var oldY = 0;
                        $(plugin.settings.viewportSelector).on("mousemove" + plugin.eventPrefix, function (e) {
                            if ((e.clientY <= plugin.settings.pageYValueForEventFired) && (e.pageY < oldY)) {
                                plugin.showModal();
                            }
                            oldY = e.pageY;
                        });
                    },
                    mouseOutEventUnbind: function () {
                        var plugin = this;
                        $(plugin.settings.viewportSelector).off("mousemove" + plugin.eventPrefix);
                    },
                    allEventsUnbind: function () {
                        var plugin = this;
                        $(plugin.settings.viewportSelector).off(plugin.eventPrefix);
                        plugin.$element.off(plugin.eventPrefix);
                    },
                    showModal: function () {
                        var plugin = this;
                        plugin.$element.modal('show');
                    },
                    hideModal: function () {
                        var plugin = this;
                        plugin.$element.modal('hide');
                    },
                    destroy: function () {
                        var plugin = this;
                        plugin.allEventsUnbind();
                        plugin.$element.data('exitModal', null);
                    }
                };

                //plugin
                function exitModalInterface(methodOrOptions) {
                    var methodsParameters = Array.prototype.slice.call(arguments, 1);
                    return this.each(function () {
                        if (!$(this).data('exitModal')) {
                            var plugin = new exitModalObj(this, methodOrOptions);
                            $(this).data('exitModal', plugin);
                            plugin.init();
                        } else if (typeof methodOrOptions === 'object') {
                            $.error('jQuery.exitModal already initialized');
                        } else {
                            var plugin = $(this).data('exitModal');
                            if (plugin[methodOrOptions]) {
                                plugin[methodOrOptions].apply(plugin, methodsParameters);
                            } else {
                                $.error('Method ' + methodOrOptions + ' does not exist on jQuery.exitModal');
                            }
                        }
                    })
                }

                //defaults options
                exitModalInterface.defaults = {
                    viewportSelector: document,
                    showButtonClose: true,
                    showButtonCloseOnlyForMobile: true,
                    pageYValueForEventFired: 10,
                    numberToShown: false,
                    modalBackdrop: true,
                    modalKeyboard: true,
                    modalShowEvent: 'show.bs.modal',
                    modalShownEvent: 'shown.bs.modal',
                    modalHideEvent: 'hide.bs.modal',
                    modalHiddenEvent: 'hidden.bs.modal',
                    callbackOnModalShow: function () { },
                    callbackOnModalShown: function () { },
                    callbackOnModalHide: function () { },
                    callbackOnModalHidden: function () { }
                };

                $.fn.exitModal = exitModalInterface;

            })();
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function () {

                var exitModalParams = {
                    numberToShown: 1,
                }
                var time2 = "<?php echo $Data['quiztime']; ?>";
        <?php if ($Data['quizstyle'] == 'exitintent') { ?>
                    setTimeout(function () {
                        setView();
                        jQuery('#myModal').exitModal(exitModalParams);
                    }, 1000);
        <?php } else { ?>
                    setTimeout(function () {
                        setView();
                        jQuery('#myPopButton').click();
                    }, 2000 + time2 * 1000);
        <?php } ?>
            });
            var endPointUrl = "<?php echo "https://" . $appUrl; ?>";
            var quizId = "<?php echo $Data['id']; ?>";
            var quizstyle = "<?php echo $Data['quizstyle']; ?>";
            var hostname = "<?php echo $Data['store_name']; ?>";
            function setView() {
                jQuery.ajax({
                    url: endPointUrl + '/Update.php',
                    type: 'GET',
                    data: 'setViews=' + quizId + '&quizstyle=' + quizstyle + '&store_name=' + hostname,
                    success: function (data) {
                        //console.log('views a');
                        //console.log(data);
                    }
                });
            }

            jQuery('body').on('click', '.LBtn:eq(0)', function () {
                completeQuiz();
                var btnColor = "<?php echo $Data['mainPagebuttonFs'] . " " . $Data['mainPagebuttonFw'] . " " . $Data['mainPagebuttonFt']; ?>";
                jQuery('.Opt-Code button').addClass(btnColor);
                jQuery('.MainPagePop').hide();
                jQuery('.Opt-Code').show();
                jQuery('.main-OptText').show();
                jQuery('.Opt-Code button').addClass('mainOptBtn');
            });
            jQuery('body').on('click', '.RBtn:eq(0)', function () {
                jQuery('.modal-body').removeClass('mainPageBGImage');
                jQuery('.modal-body').addClass('secondBGImage');
                jQuery('.MainPagePop').hide();
                jQuery('.secondChance').show();
            });

            jQuery('body').on('click', '.LBtn:eq(1)', function () {
                completeQuiz();
                var btnColor = "<?php echo $Data['SecondThankyouDescFs'] . " " . $Data['SecondThankyouDescFw'] . " " . $Data['SecondThankyouDescFt']; ?>";
                jQuery('.Opt-Code button').addClass(btnColor);
                jQuery('.secondChance').hide();
                jQuery('.Opt-Code').show();
                jQuery('.sec-OptText').show();
                jQuery('.Opt-Code button').addClass('secOptBtn');
            });
            jQuery('body').on('click', '.RBtn:eq(1)', function () {
                jQuery('#myModal').modal('toggle');
            });
            jQuery('body').on('click', '.secOptBtn', function () {
                /*var btnColor = "<?php echo $Data['SecondThankyouDescFs'] . " " . $Data['SecondThankyouDescFw'] . " " . $Data['SecondThankyouDescFt']; ?>";
                 jQuery('.SecondTY button').addClass(btnColor);*/
                if (jQuery('#name').val() == '') {
                    jQuery('#email-error').text('Please enter name.');
                } else if (jQuery('#email').val().search('@') > 0 && jQuery('#email').val().search('.') >= 0) {
                    jQuery('.Opt-Code').hide();
                    jQuery('.SecondTY').show();
                    submitEmail(jQuery('#email').val(), jQuery('#listname').val(), jQuery('#apiname').val(), jQuery('#name').val());
                } else {
                    jQuery('#email-error').text('Please enter a valid email address.')
                }
            });
            jQuery('body').on('click', '.mainOptBtn', function () {
                /*var btnColor = "<?php echo $Data['mainPagebuttonFs'] . " " . $Data['mainPagebuttonFw'] . " " . $Data['mainPagebuttonFt']; ?>";
                 jQuery('.mainPageTY button').addClass(btnColor);*/
                if (jQuery('#name').val() == '') {
                    jQuery('#email-error').text('Please enter name.');
                } else if (jQuery('#email').val().search('@') > 0 && jQuery('#email').val().search('.') >= 0) {
                    jQuery('.Opt-Code').hide();
                    jQuery('.mainPageTY').show();
                    submitEmail(jQuery('#email').val(), jQuery('#listname').val(), jQuery('#apiname').val(), jQuery('#name').val());
                } else {
                    jQuery('#email-error').text('Please enter a valid email address.')
                }
            });

            function completeQuiz() {
                var quizid = "<?php echo $Data['id']; ?>";
                var quizstyle = "<?php echo $Data['quizstyle']; ?>";
                var hostname = window.location.hostname;
                jQuery.ajax({
                    url: endPointUrl + '/Update.php',
                    type: 'GET',
                    data: 'CompleteQuiz=' + quizId + '&quizstyle=' + quizstyle + '&store_name=' + hostname,
                    success: function (data) {
                        //console.log('views a');
                        //console.log(data);
                    }
                });
            }

            function EmailQuiz() {
                var quizid = "<?php echo $Data['id']; ?>";
                var quizstyle = "<?php echo $Data['quizstyle']; ?>";
                var hostname = window.location.hostname;
                jQuery.ajax({
                    url: endPointUrl + '/Update.php',
                    type: 'GET',
                    data: 'EmailQuiz=' + quizId + '&quizstyle=' + quizstyle + '&store_name=' + hostname,
                    success: function (data) {
                        //console.log('views a');
                        //console.log(data);
                    }
                });
            }

            function submitEmail(email, listid, apiname, name) {
                var hostname = window.location.hostname;
                EmailQuiz();
                if (apiname == 'mailchimp') {
                    jQuery.post({
                        url: endPointUrl + '/mailchimp/index.php',
                        type: 'post',
                        data: 'email=' + email + '&listid=' + listid + '&hostname=' + hostname + '&name=' + name,
                        success: function (data) {
                            console.log('data');
                            console.log(data);
                        }
                    });
                }
                if (apiname == 'aweber') {
                    jQuery.post({
                        url: endPointUrl + '/Aweber/demo.php',
                        type: 'post',
                        data: 'email=' + email + '&listid=' + listid + '&hostname=' + hostname + '&name=' + name,
                        success: function (data) {
                            console.log('data');
                            console.log(data);
                        }
                    });
                }
            }
        </script>

        <?php }
}
?>