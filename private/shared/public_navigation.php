<?php
	//Default value to prevent error
	$contact_id = $contact_id ?? '';
	$group_id = $group_id ?? '';
	$visible = $visible == 1;   //Preview
?>

<navigation>
  <?php $nav_groups = find_all_groups($db, ['VISIBLE' => $visible]); ?>
  <table id="customers">
      <?php if ($nav_groups !== null) {
      foreach($nav_groups as $nav_group) { ?>
      <tbody>

      <tr>
        <th colspan="6" class="<?php if($nav_group->ID == $group_id) {echo 'selected';}  ?>" >
          <!--<a href="<?php echo url_for('index.php?group_id=' . h(u($nav_group->ID))); ?>">--><!--FOR COLLAPSIBLE-->
			      <?php echo h($nav_group->GROUP_NAME); ?>
			    <!--</a>-->
        </th>
      </tr>
      <tr>
        <td>Name</td>
        <td>Personal Cell</td>
        <td>Work Cell</td>
        <td>Work Desk</td>
        <td>Ext</td>
        <td>Fax</td>
      </tr>	
      <?php //if($nav_group->ID == $group_id) { ?><!--FOR COLLAPSIBLE-->
      <?php $nav_contacts = find_contacts_by_group_id($db, $nav_group->ID, ['VISIBLE' => $visible]); //var_dump($nav_contacts);?>
      <?php if ($nav_contacts !== null) {
      foreach($nav_contacts as $nav_contact) { ?>
      <tr>
        <td class="<?php if($nav_contact->ID == $contact_id) {echo 'selected';}  ?>" >
          <a href="<?php echo url_for('index.php?id=' . h(u($nav_contact->ID))); ?>">
            <?php 
              echo 
                h($nav_contact->FIRST_NAME) . " " . 
                h($nav_contact->LAST_NAME) . ", " . 
                h($nav_contact->TITLE) . " (" . 
                h($nav_contact->AGENCY) . "-" . 
                h($nav_contact->OFFICE) . ")"; 
            ?>
          </a>
        </td>
        <td class="<?php if($nav_contact->ID == $contact_id) {echo 'selected';}  ?>" >
          <a href="<?php echo url_for('index.php?id=' . h(u($nav_contact->ID))); ?>">
            <?php echo h($nav_contact->PERSONAL_CELL); ?>
          </a>
        </td>
        <td class="<?php if($nav_contact->ID == $contact_id) {echo 'selected';}  ?>" >
          <a href="<?php echo url_for('index.php?id=' . h(u($nav_contact->ID))); ?>">
            <?php echo h($nav_contact->WORK_CELL); ?>
          </a>
        </td>
        <td class="<?php if($nav_contact->ID == $contact_id) {echo 'selected';}  ?>" >
          <a href="<?php echo url_for('index.php?id=' . h(u($nav_contact->ID))); ?>">
            <?php echo h($nav_contact->WORK_DESK); ?>
          </a>
        </td>
		    <td class="<?php if($nav_contact->ID == $contact_id) {echo 'selected';}  ?>" >
          <a href="<?php echo url_for('index.php?id=' . h(u($nav_contact->ID))); ?>">
            <?php echo h($nav_contact->EXTENSION); ?>
          </a>
        </td>
        <td class="<?php if($nav_contact->ID == $contact_id) {echo 'selected';}  ?>" >
          <a href="<?php echo url_for('index.php?id=' . h(u($nav_contact->ID))); ?>">
            <?php echo h($nav_contact->FAX); ?>
          </a>
        </td>
      </tr>
      <?php 
        } // foreach $nav_contacts 
      } // foreach $nav_contacts
      ?>	
		  
      <?php 
          //} // if($nav_group->ID == $group_id)<!--FOR COLLAPSIBLE-->
      ?>

      </tbody>
      <?php 										  
        }// foreach $nav_groups
      }// foreach $nav_groups 
      ?>
  </table>
</navigation>