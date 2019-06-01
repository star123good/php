<table border="0" cellspacing="0" cellpadding="20" width="670" style="color:#333333;font-family:Arial,sans-serif;font-size:12px;line-height:18px" align="center">
    <tbody>
        <tr>
            <td style="padding-top:25px;padding-bottom:0">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="border-bottom:1px solid #f1f1f1;padding:25px 25px;font-size:21px;color:#03B33B" align="center" valign="top" width="50%">
                                <?php _e('New users', 'reminder'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom:1px solid #f1f1f1;padding:15px 25px;font-size:21px;color:#03B33B" align="center" valign="top" width="50%">
                                <span style="text-transform:uppercase;color:#999;font-size:11px"><?php echo $period_name; ?></span>
                                <strong style="font-size:24px;display:block;letter-spacing:-1px;line-height:38px"><?php echo $aUserStatsPeriod; ?> <span style="font-weight:normal"><?php _e(' users', 'reminder'); ?></span></strong>
                                <span style="font-size:11px;color:#999"><strong style="<?php echo ($avg_users_previous>=0) ? "color:#96ac00": "color:#cc0033"; ?>"><?php echo $avg_users_previous; ?>%</strong> <?php _e('versus previous period', 'reminder'); ?></span>
                                <p>
                                    <span style="font-size:11px;color:#999">&nbsp;<?php echo $aUserStatsPreviousPeriod. ' ' . __('users', 'reminder') ; ?></span>
                                    <br/><span style="font-size:11px;color:#999"><?php echo '(' . $dt_last_period_start. '<br/>' . $dt_last_period_end . ')' ; ?></span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom:1px solid #f1f1f1;padding:25px 25px;font-size:21px;color:#03B33B" align="center" valign="top" width="50%">
                                <?php _e('New items', 'reminder'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom:1px solid #f1f1f1;padding:15px 25px;font-size:21px;color:#03B33B" align="center" valign="top" width="50%">
                                <span style="text-transform:uppercase;color:#999;font-size:11px"><?php echo $period_name; ?></span>
                                <strong style="font-size:24px;display:block;letter-spacing:-1px;line-height:38px"><?php echo $aItemsStatsPeriod; ?> <span style="font-weight:normal"><?php _e(' listings', 'reminder'); ?></span></span></strong>
                                <span style="font-size:11px;color:#999"><strong style="<?php echo ($avg_items_previous>=0) ? "color:#96ac00": "color:#cc0033"; ?>"><?php echo $avg_items_previous; ?>%</strong> <?php _e('versus previous period', 'reminder'); ?></span>
                                <p>
                                    <span style="font-size:11px;color:#999">&nbsp;<?php echo $aItemsStatsPreviousPeriod. ' ' . __('listings', 'reminder') ; ?></span>
                                    <br/><span style="font-size:11px;color:#999"><?php echo '(' . $dt_last_period_start. '<br/>' . $dt_last_period_end . ')' ; ?></span>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </td>
        </tr>
<!--        <tr>
            <td style="border-bottom:1px solid #f1f1f1;padding-top:35px;font-size:21px;color:#ff9a00">
                Herramientas
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="color:#333333;font-family:Arial,sans-serif;font-size:12px;line-height:18px" align="center">
                    <tbody>
                        <tr>
                            <td style="padding:40px;font-size:12px;line-height:16px;padding:20px 30px" align="center" width="50%" valign="top">
                                <img width="201" height="115" src="https://ci5.googleusercontent.com/proxy/Nq0w1Eh7GVOLWt79D8via8f4_THnpIQK336fALjIRmYJqExq6b7BQ2QVh-9334zUPLXZ4K90T2_lplmx0XkRl9V5eqkJYW2w17Y8Dg=s0-d-e1-ft#https://partners.trovit.com/images/mail/conversion.gif" style="display:block;margin-bottom:10px" class="CToWUd">
                                <strong style="font-size:15px;line-height:28px"><a href="https://partners.trovit.com/index.php/cod.conversion_tracking" style="color:#2200c1;text-decoration:none" target="_blank">Conversiones</a></strong>
                                <br>Actívala para poder medir tus conversiones desde <span class="il">Trovit</span>
                            </td>
                            <td style="border-left:1px dotted #f1f1f1;padding:40px;font-size:12px;line-height:16px;padding:20px 30px" align="center" width="50%" valign="top">
                                <img width="201" height="115" src="https://ci3.googleusercontent.com/proxy/2x58Zow8VZaMH8cRoIGLDj2l9pUQVb5AidPLghDxVqo4GFQ823pzV17Xr0HkrkwRrsAfO76q_nGj7VgUwEs4AMtw7qmj7qBqXlhtTBU7=s0-d-e1-ft#https://partners.trovit.com/images/mail/segmentation.gif" style="display:block;margin-bottom:10px" class="CToWUd">
                                <strong style="font-size:15px;line-height:28px"><a href="https://partners.trovit.com/index.php/cod.traffic_tracking" style="color:#2200c1;text-decoration:none" target="_blank">Seguimiento de tráfico</a></strong>
                                <br>Implementa la etiqueta para poder medir con precisión el tráfico que te llega desde <span class="il">Trovit</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top:1px solid #f1f1f1;font-size:12px;line-height:18px;padding:30px 20px">
                <p>
                    Si tienes alguna duda o quieres ponerte en contacto con nosotros puedes hacerlo en <a href="mailto:spain@trovit.com" target="_blank">spain@<span class="il">trovit</span>.com</a>. Muchas gracias por confiar en <span class="il">Trovit</span>.
                </p>
            </td>
        </tr>-->
    </tbody>
</table>