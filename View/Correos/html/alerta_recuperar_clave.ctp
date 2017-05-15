<table align="center" border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 600px; margin: 0 auto;">
	<tr>
		<td style="border-top: #dbdbdb 1px solid; border-right: #dbdbdb 1px solid; border-bottom: #dbdbdb 1px solid; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; border-left: #dbdbdb 1px solid; padding-right: 0px; background-color: #feffff">
			<table class=rtable style="width: 100%; padding: 15px;"cellspacing=0 cellpadding=0 align=left>
				<tr>
					<td><?=$this->Html->image('../backend/img/template/logo-manpower-email.png', array('width' => 200));?></td>
				</tr>
				<tr style="height: 10px">
					<td style="border-top: medium none; border-right: medium none; width: 100%; vertical-align: top; border-bottom: medium none; padding-bottom: 35px; text-align: center; padding-top: 35px; padding-left: 15px; border-left: medium none; padding-right: 15px; background-color: #feffff">
						<p style="margin-bottom: 1em; font-size: 18px; font-family: arial, helvetica, sans-serif; color: #0A82AD; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align=center>
							<strong><?=$alerta['titulo']?></strong>
						</p>
						<p style="margin-bottom: 1em; font-size: 12px; font-family: arial, helvetica, sans-serif; color: #a7a7a7; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align=center>
							<?=$alerta['cuerpo']?>
						</p>
						<p style="margin-bottom: 1em; font-size: 12px; font-family: arial, helvetica, sans-serif; color: #a7a7a7; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align=center>
							<?=$alerta['cuerpo2']?>
						</p>
						
						<p style="margin-bottom: 1em; font-size: 12px; font-family: arial, helvetica, sans-serif; color: #a7a7a7; padding-left: 0px; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align=center>&#160;</p>
						<?=$this->html->link('Ingresar al portal', array(
							'controller' => 'empresas', 
							'action' => 'login', 
							'businesses' => true,
							'full_base' => true), 
							array(
								'style' => 'background-color:#43AB86; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none;'
							)
						);?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>