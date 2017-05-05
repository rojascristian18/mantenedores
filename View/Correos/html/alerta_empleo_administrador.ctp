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
							<strong><?=$alerta['titulo_admin'];?></strong>
						</p>
						<p style="margin-bottom: 1em; font-size: 12px; font-family: arial, helvetica, sans-serif; color: #a7a7a7; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align=center>
							<?=$alerta['cuerpo_admin'];?>
						</p>
						<ul style="margin-bottom: 1em; font-size: 12px; font-family: arial, helvetica, sans-serif; color: #a7a7a7; padding-left: 20px; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align="center">
							<? 	if ( ! empty($alerta['Empresa']['nombre']) ) : ?>
									<li style="text-align: left;"><strong>Empresa que publica: </strong><?=$alerta['Empresa']['nombre'];?></li>
							<?	endif; ?>
							<? 	if ( ! empty($alerta['Empleo']['titulo']) ) : ?>
									<li style="text-align: left;"><strong>Título: </strong><?=$alerta['Empleo']['titulo'];?></li>
							<?	endif; ?>
							<? 	if ( ! empty($alerta['Comuna']['comuna']) ) : ?>
									<li style="text-align: left;"><strong>Ubicación del empleo: </strong><?=$alerta['Comuna']['comuna'];?> - <?=$alerta['Comuna']['Ciudad']['ciudad'];?> - <?=$alerta['Comuna']['Ciudad']['Region']['region'];?> - <?=$alerta['Comuna']['Ciudad']['Region']['Pais']['pais'];?></li>
							<?	endif; ?>
							<? 	if ( ! empty($alerta['JornadaLaboral']['nombre']) ) : ?>
									<li style="text-align: left;"><strong>Jornada laboral: </strong><?=$alerta['JornadaLaboral']['nombre'];?></li>
							<?	endif; ?>
							<? 	if ( ! empty($alerta['ContratoOfrecido']['nombre']) ) : ?>
									<li style="text-align: left;"><strong>Tipo de contrato: </strong><?=$alerta['ContratoOfrecido']['nombre'];?></li>
							<?	endif; ?>
							<? 	if ( ! empty($alerta['AnnoExperiencia']['anno_experiencia']) ) : ?>
									<li style="text-align: left;"><strong>Años de experiencia: </strong><?=$alerta['AnnoExperiencia']['anno_experiencia'];?></li>
							<?	endif; ?>
							<? 	if ( ! empty($alerta['Empleo']['sueldo']) ) : ?>
									<li style="text-align: left;"><strong>Sueldo ofrecido: </strong><?=$alerta['Empleo']['sueldo'];?></li>
							<?	endif; ?>
							<li style="text-align: left"><strong>Fecha de env&#237;o:</strong> <?= date('Y-m-d', strtotime($alerta['Empleo']['created'])); ?></li>
							<li style="text-align: left"><strong>Hora de env&#237;o:</strong> <?= date('g:i A', strtotime($alerta['Empleo']['created'])); ?></li>
						</ul>
						<p style="margin-bottom: 1em; font-size: 12px; font-family: arial, helvetica, sans-serif; color: #a7a7a7; padding-left: 0px; margin-top: 0px; line-height: 155%; background-color: transparent; mso-line-height-rule: exactly" align=center>&#160;</p>
						<?=$this->html->link('Gestionar oferta', array(
							'controller' => 'empleos', 
							'action' => 'view', 
							'admin' => true,
							'full_base' => true, 
							$alerta['Empleo']['id']), array(
							'style' => 'background-color:#43AB86; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none;'
							)
						);?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>