<?php if (($user = $visitor->operator_user) !== false) : ?>
<?php $hideThumbs = true;$extraMessage = $user->job_title != '' ? htmlspecialchars($user->job_title) : erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Personal assistant');?>
<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/operator_profile.tpl.php'));?>
<?php endif;?>

<div id="messages" class="mb10">
     <div class="msgBlock" id="messagesBlock">
       	<div class="message-row response"><div class="msg-date"><?php echo date(erLhcoreClassModule::$dateHourFormat,time()-5); ?></div><span class="usr-tit"><img src="<?php echo erLhcoreClassDesign::design('images/icons/user_suit.png');?>" title="" alt="" />&nbsp;</span><?php echo erLhcoreClassBBCode::make_clickable(htmlspecialchars($visitor->operator_message)); ?></div>
     </div>
</div>

<form action="" id="ReadOperatorMessage" method="post" onsubmit="return lhinst.addCaptcha('<?php echo time()?>',$(this))">

<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if ($visitor->requires_username == 1 || $visitor->requires_email == 1) : ?><div class="row"><?php endif;?>

<?php if ($visitor->requires_username == 1) : ?>
<div class="columns small-6">
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Name');?>*</label>
	<input type="text" name="Username" value="<?php echo htmlspecialchars($input_data->username);?>" />
</div>
<?php endif; ?>

<?php if ($visitor->requires_email == 1) : ?>
<div class="columns small-6">
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','E-mail');?>*</label>
	<input type="text" name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
</div>
<?php endif; ?>

<?php if ($visitor->requires_username == 1 || $visitor->requires_email == 1) : ?></div><?php endif;?>

<textarea placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Type your message here and hit enter to send...');?>" id="id_Question" name="Question"><?php echo htmlspecialchars($input_data->question);?></textarea>

<input type="hidden" value="<?php echo htmlspecialchars($referer);?>" name="URLRefer"/>
<input type="hidden" value="<?php echo htmlspecialchars($referer_site);?>" name="r"/>

<?php if ($department === false) : ?>
	<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/department.tpl.php'));?>
<?php endif;?>

<input type="submit" name="askQuestionAction" id="idaskQuestionAction" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Send');?>" class="tiny button radius secondary"/>
<input type="hidden" name="askQuestion" value="1" />

</form>

<script>
jQuery('#id_Question').bind('keyup', 'return', function (evt){
	$( "#idaskQuestionAction" ).click();	
});
<?php if ($playsound == true) : ?>
$(function() {lhinst.playInvitationSound();});
<?php endif; ?>
</script>
