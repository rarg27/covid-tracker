<?php

?>
<page style="color: black"
      backimg="<?php echo base_path('public/images/id-bg2.png') ?>"
      backimgx="0"
      backimgy="0"
      backimgw="125%">
    <table style="width: 100%;">
        <tr>
            <td style="width: 45%">
                <br />
                <br />
                <h4>IMPORTANT</h4>
                <h5>
                    This ID represents the bearer as a passenger
                    in KGSP TODA and a good resident of our Barangay
                    helping us fight against COVID-19 by participating
                    in our tracing system.
                </h5>
                <h5>
                    In the event that this ID was lost, kindly
                    notify us at the Brgy. Bagbag's office.
                </h5>
                <h5>
                    VALID UNTIL: December 31, 2021<br />CONTROL NUMBER: <?php echo substr(strval(now()->year), -2).'-'.str_pad($id, 6, '0', STR_PAD_LEFT) ?>
                </h5>
                <img style="display: inline-block; height: 50px; width: 50px;" src="<?php echo base_path('public/images/brgy-bagbag.png') ?>" />
                <img style="display: inline-block; height: 50px; width: 50px;" src="<?php echo base_path('public/images/kgsp-toda.png') ?>" />
            </td>
            <td style="text-align:center; width: 55%">
                <br />
                <br />
                <br />
                <qrcode value="<?php echo $qrcode; ?>" ec="H" style="height: 250px; width: 250px;">
                </qrcode>
            </td>
        </tr>
    </table>
</page>
