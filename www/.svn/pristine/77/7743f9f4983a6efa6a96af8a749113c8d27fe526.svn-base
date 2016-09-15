<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Newsletters_Ajax_Controller extends Controller_Core {
    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function validate_newsletter_add() {
        $clean = array();
        foreach ($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        Kohana::log('debug', print_r($clean, true));
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if (empty($clean['title']) || $clean['title'] == '') {
            $element = $xml->addChild('error', Kohana::lang('newsletter.newsletter_title_required'));
            $element->addAttribute('id', 'title');
            $element->addAttribute('class', 'error');
            $counter++;
        }
        if (empty($clean['description']) || $clean['description'] == '') {
            $element = $xml->addChild('error', Kohana::lang('newsletter.newsletter_content_required'));
            $element->addAttribute('id', 'description');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }

    public function send__old() {
        $newsletter = new Newsletter_Model();
        $db = new Database();
        $oEmails = $newsletter->FindAllEmailsForGroups($_POST['limit'], $_POST['offset'], $_POST['groups'])->Value;
        //$oEmails = $newsletter->FindAllEmails($_POST['limit'], $_POST['offset'])->Value;
        if (!empty($oEmails) && $oEmails->count() == 0) {
            echo 'EOF';
        } else {
            $oNewsletterDetails = $db->limit(1)->getwhere(table::NEWSLETTERS, array('id_newsletter' => $_POST['id']));
            $body = new View('emails/newsletter_layout_default');
            $body->sContent = $oNewsletterDetails[0]->content;
            $title = $oNewsletterDetails[0]->title;
            $altBody = strip_tags(str_replace("<br />", "\n", $oNewsletterDetails[0]->content));
            $from = config::getConfig('administrator_email');
            foreach ($oEmails as $e) {
                if (email::send($e->email, $from, $title, $body, TRUE)) {
                    echo '&nbsp;&nbsp;&nbsp;Wysłano e-mail do: ' . ($e->email) . '<br />';
                } else {
                    echo 'Błąd podczas wysyłania e-maila do: ' . ($e->email) . '<br />';
                }
            }
        }
    }
/*
    public function send() {
        $newsletter = new Newsletter_Model();
        $db = new Database();
        $oEmails = $newsletter->FindAllEmailsForGroups($_POST['limit'], $_POST['offset'], $_POST['groups'], $_POST['id'])->Value;
        //$oEmails = $newsletter->FindAllEmails($_POST['limit'], $_POST['offset'])->Value;
        if (!empty($oEmails) && $oEmails->count() == 0) {
			$db->update(table::NEWSLETTERS, array('date_sent' => time()), array('id_newsletter' => $_POST['id']));
            echo 'EOF';
        } else {
            $oNewsletterDetails = $db->limit(1)->getwhere(table::NEWSLETTERS, array('id_newsletter' => $_POST['id']));
            $body = new View(newsletter::NEWSLETTER_VIEW);
            $body->sContent = $oNewsletterDetails[0]->content;
            $body->sNewsletterTitle = $oNewsletterDetails[0]->title;

            $oImages = $newsletter->getImages($_POST['id'])->Value;
            if (!empty($oImages)) {
                $body->oImages = $oImages;
            } else {
                $body->oImages = array();
            }

            $altBody = strip_tags(str_replace("<br />", "\n", $oNewsletterDetails[0]->content));
            $from = config::getConfig('sending_email');
            $from_name = config::getConfig('sending_name');
            if (!empty($from_name)) {
                $from = array($from, $from_name);
            }
            foreach ($oEmails as $e) {
                if(! filter_var($e->email, FILTER_VALIDATE_EMAIL)){
                    echo 'Zły format maila: ' . ($e->email) . '<br />';
                    continue;
                }
                
                $body->email = $e->email;
                $body->verifyString = $e->verify_string;
                $to = $e->email;
                if (isset($e->name) && !empty($e->name)) {
                    $to = array($e->email, $e->name);
                }

                if (email::send($to, $from, $body->sNewsletterTitle, $body, TRUE)) {
                    echo '&nbsp;&nbsp;&nbsp;Wysłano e-mail do: ' . ($e->email) . '<br />';
                    $newsletter->SaveSent($_POST['id'],$e->id_email);
                } else {
                    echo 'Błąd podczas wysyłania e-maila do: ' . ($e->email) . '<br />';
                }
            }
        }
    }
*/
     public function send() {
        $newsletter = new Newsletter_Model();
        $db = new Database();
        $oEmails = $newsletter->FindAllEmailsForGroups($_POST['limit'], $_POST['offset'], $_POST['groups'], $_POST['id'])->Value;
        //$oEmails = $newsletter->FindAllEmails($_POST['limit'], $_POST['offset'])->Value;
        if (!empty($oEmails) && $oEmails->count() == 0) {
            $db->update(table::NEWSLETTERS, array('date_sent' => time()), array('id_newsletter' => $_POST['id']));
            echo 'EOF';
        } else {
            $oNewsletterDetails = $db->limit(1)->getwhere(table::NEWSLETTERS, array('id_newsletter' => $_POST['id']));
            $body = new View(newsletter::NEWSLETTER_VIEW);


            require Kohana::find_file('vendor', 'swift5/lib/swift_required');

            $body->sContent = $oNewsletterDetails[0]->content;

            $body->sNewsletterTitle = $oNewsletterDetails[0]->title;

            $oImages = $newsletter->getImages($_POST['id'])->Value;
            if (!empty($oImages)) {
                $body->oImages = $oImages;
            } else {
                $body->oImages = array();
            }

            $altBody = strip_tags(str_replace("<br />", "\n", $oNewsletterDetails[0]->content));
            $from = config::getConfig('sending_email');
            $from_name = config::getConfig('sending_name');
            if (!empty($from_name)) {
                $from = array($from => $from_name);
            }
            foreach ($oEmails as $e) {
                if (!filter_var($e->email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Zły format maila: ' . ($e->email) . '<br />';
                    continue;
                }
                
                
                $mailer = email::connect();
                $email = Swift_Message::newInstance($body->sNewsletterTitle);
                
                $body->email = $e->email;
                //$body->name = $e->name;
               // $body->plan = $e->plan;
               // $body->ready = $e->ready;
               // $body->pready = $e->pready;
                $body->bgtop = $email->embed(Swift_Image::fromPath('img/bgtop.jpg'));
                $body->logo1 = $email->embed(Swift_Image::fromPath('img/logo1.jpg'));
                $body->wave = $email->embed(Swift_Image::fromPath('img/wave.jpg'));
                $body->logo2 = $email->embed(Swift_Image::fromPath('img/logo2.jpg'));
                $body->verifyString = $e->verify_string;
                $to = $e->email;
                if (isset($e->name) && !empty($e->name)) {
                   $to = array($e->email => $e->name);
               }
               $email->setContentType("text/html");

                $email->setSubject($body->sNewsletterTitle);
                $email->setFrom($from);
                $email->setTo($to);
                $email->setBody($body);

                if ($mailer->send($email)) {
                    echo '&nbsp;&nbsp;&nbsp;Wysłano e-mail do: ' . ($e->email) . '<br />';
                    $newsletter->SaveSent($_POST['id'], $e->id_email);
                } else {
                    echo 'Błąd podczas wysyłania e-maila do: ' . ($e->email) . '<br />';
                }
            }
        }
    }
    public function deleteImage() {
        $id_image = 0 + $_GET['id_image'];

        $db = new Database();
        $image = $db->getwhere(table::NEWSLETTER_IMAGES, array('id_image' => $id_image));

        if (count($image) > 0) {
            unlink(newsletter::IMAGE_NEWSLETTER_PATH . $image[0]->filename);
            $db->delete(table::NEWSLETTER_IMAGES, array('id_image' => $id_image));
            echo '1';
        } else {
            echo '0';
        }
    }

    public function change_email_status() {
        if (!isset($_GET['id_email'])) {
            return;
        }

        $id_email = intval($_GET['id_email']);
        $db = new Database();
        $result = $db->select('newsletter_email_active')
                ->from(table::NEWSLETTER_EMAILS)
                ->where('id_email', $id_email)
                ->get();

        if (isset($result[0])) {
            if ($result[0]->newsletter_email_active == 'Y') {
                $status = 'N';
            } else {
                $status = 'Y';
            }
            $db->update(table::NEWSLETTER_EMAILS, array('newsletter_email_active' => $status), array('id_email' => $id_email));
            echo $status;
            return;
        } else {
            return;
        }
    }

    public function validate_group() {
        $clean = array();
        foreach ($_POST as $key => $value) {
            $clean[$key] = urldecode($value);
        }
        Kohana::log('debug', print_r($clean, true));
        header('Content-type: text/xml; charset=utf-8');
        $counter = 0;
        $defString = '<?xml version="1.0" encoding="UTF-8"?><validation></validation>';
        $xml = new SimpleXMLElement($defString);

        if (empty($clean['name']) || $clean['name'] == '') {
            $element = $xml->addChild('error', Kohana::lang('newsletter.newsletter_name_required'));
            $element->addAttribute('id', 'name');
            $element->addAttribute('class', 'error');
            $counter++;
        }

        $xml->addAttribute('counter', $counter);
        echo $xml->asXML();
    }
	
	public function get_groups_for_lang() {
		if (!empty($_POST)) {
			$this->_newsletter = new Newsletter_Model();
			if (!empty($_POST['id'])) {
				$oNewsletterGroups = $this->_newsletter->FindAllNewsletterGroups($_POST['id'])->Value;
				if (!empty($oNewsletterGroups) && $oNewsletterGroups->count() > 0) {
					$aNewsletterGroups = array();
					foreach ($oNewsletterGroups as $group) {
						$aNewsletterGroups[] = $group->newsletter_group_id;
					}
				}
			}
			$oGroups = $this->_newsletter->FindAllGroups(null, null, array('lang' => $_POST['lang']))->Value;
			if (!empty($oGroups) && $oGroups->count() > 0) {
				$response = '';
				foreach ($oGroups as $group) {
					$response .= '<li><input type="checkbox" name="newsletter_group[' . $group->id_newsletter_group . ']" id="newsletter_group_' . $group->id_newsletter_group . '"' . $group->id_newsletter_group . '"' . ((!empty($aNewsletterGroups) && count($aNewsletterGroups) && in_array($group->id_newsletter_group, $aNewsletterGroups)) ? ' checked="checked"' : '') . ' /><label for="newsletter_group_' . $group->id_newsletter_group . '">' . $group->name . '</label></li>';
				}
				echo $response;
			} else {
				echo '<li>Brak zdefiniowanych grup dla wybranego języka.</li>';
			}
		}
	}

}