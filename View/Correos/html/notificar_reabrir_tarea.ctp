
<TABLE class="rtable mainTable" cellSpacing=0 cellPadding=0 width="100%" bgColor=#f3f3f3>
  <TR>
    <TD style="FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0">&#160;</TD>
  </TR>
  <TR>
    <TD vAlign=top>
      <TABLE class=rtable style="WIDTH: 600px; MARGIN: 0px auto" cellSpacing=0 cellPadding=0 width=600 align=center border=0>
        <TR>
          <TD style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127">
            <TABLE class=rtable style="WIDTH: 100%" cellSpacing=0 cellPadding=0 align=left>
              <TR style="HEIGHT: 10px">
                <TD style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent">
                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>
                    <TR>
                      <TD style="PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px" align=center>
                        <TABLE cellSpacing=0 cellPadding=0 border=0>
                          <TR>
                            <TD style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent">
                              <?=$this->Html->image('nodrizablanco.png', array('vspace' => '0', 'hspace' => 0, 'border' => 0, 'class' => 'rimg', 'style' => 'MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent', 'fullBase' => true));?>
                            </TD>
                          </TR>
                        </TABLE>
                      </TD>
                    </TR>
                  </TABLE>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
        <TR>
          <TD style="BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff">
            <TABLE class=rtable style="WIDTH: 100%" cellSpacing=0 cellPadding=0 align=left>
              <TR style="HEIGHT: 20px">
                <TD style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff">
                  <P style="FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align=left>
                    Estimado/a <?= $alerta['Usuario']['nombre']; ?><br>
                    <STRONG>La tarea identificador #<?=$alerta['Tarea']['id'];?>, nombre <?=$alerta['Tarea']['nombre'];?>, ha sido abierta nuevamente.</STRONG>
                  </P>
                  <P style="FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align=left>
                  Sí tiene dudas, revise los comentarios e la tarea o contácte con el administrador.
                  <BR>
                  <BR>Para comenzar a trabajar ingrese al portal haciendo click en el siguiente link:
                  <BR>
                  <?=$this->html->link('Ingresar a la tarea', array(
                      'controller' => 'tareas', 
                      'action' => 'work',
                      $alerta['Tarea']['id'],
                      'maintainers' => true,
                      'full_base' => true), 
                      array(
                      'style' => 'background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;'
                      )
                    );?>
                  <BR>
                  <BR>
                  <P style="FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
        <TR>
          <TD style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent">
            <TABLE class=rtable style="WIDTH: 100%" cellSpacing=0 cellPadding=0 align=left>
              <TR style="HEIGHT: 10px">
                <TD style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent">
                  <P style="FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>
                  <P style="FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE>
    </TD>
  </TR>
  <TR>
    <TD style="FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0">&#160;
    </TD>
  </TR>
</TABLE>
