<?php
require_once('../docusign-php-client/autoload.php');

$username = "213ba94b-cb7a-4bd8-a11e-6cfbd3b0071d";
$password = "pingpong";
$integrator_key = "27616b49-0905-4fb9-aba4-383eef6ba1a7";

// change to production (www.docusign.net) before going live
$host = "https://demo.docusign.net/restapi";

// create configuration object and configure custom auth header
$config = new DocuSign\eSign\Configuration();
$config->setHost($host);
$config->setSSLVerification(false);
$config->addDefaultHeader("X-DocuSign-Authentication", "{\"Username\":\"" . $username . "\",\"Password\":\"" . $password . "\",\"IntegratorKey\":\"" . $integrator_key . "\"}");

// instantiate a new docusign api client
$apiClient = new DocuSign\eSign\ApiClient($config);
$accountId = null;

$authenticationApi = new DocuSign\eSign\Api\AuthenticationApi($apiClient);
$options = new \DocuSign\eSign\Api\AuthenticationApi\LoginOptions();
$loginInformation = $authenticationApi->login($options);
if(isset($loginInformation) && count($loginInformation) > 0) {
    $loginAccount = $loginInformation->getLoginAccounts()[0];
    $host = $loginAccount->getBaseUrl();
    $host = explode("/v2", $host);
    $host = $host[0];
    // UPDATE configuration object
    $config->setHost($host);

    // instantiate a NEW docusign api client (that has the correct baseUrl/host)
    $apiClient = new DocuSign\eSign\ApiClient($config);


    if(isset($loginInformation))
    {
        $accountId = $loginAccount->getAccountId();
        if(!empty($accountId))
        {
            $templateApi = new DocuSign\eSign\Api\TemplatesApi($apiClient);

            $envelope_template_definition= new DocuSign\eSign\Model\EnvelopeTemplateDefinition();
            $envelope_template_definition->setName('Document Ginger Ale');
            $envelope_template_definition->setDescription('This is a test Template');

//            $envelope_document = new DocuSign\eSign\Model\Document();
//            $envelope_document->setUri('http://testshinehub.herokuapp.com/public/Docs/SignTest1.pdf');
//            $envelope_document->setName('SomeTestDoc');
//            $envelope_document->setDocumentId(1);
//            $envelope_document->setFileExtension('pdf');

            $signers = new DocuSign\eSign\Model\Signer();
            $signers->setName('Jon Doe');
            $signers->setRecipientId(1);
            $signers->setEmail('abc@xyz.rst');

            $signer2 = new DocuSign\eSign\Model\Signer();
            $signer2->setName('Me Check');
            $signer2->setRecipientId(2);
            $signer2->setEmail('aerodott@gmail.com');

            $envelope_recipient= new DocuSign\eSign\Model\Recipients();
            $envelope_recipient->setSigners([$signers,$signer2]);

            $envelope_definition= new DocuSign\eSign\Model\EnvelopeTemplate();//['','','','','']
            $envelope_definition->setEmailSubject('Please Sign this');
            $envelope_definition->setStatus('sent');
            //$envelope_definition->setDocuments([$envelope_document]);
            $envelope_definition->setEnvelopeTemplateDefinition($envelope_template_definition);
            $envelope_definition->setRecipients($envelope_recipient);

//            $templateRole = new  DocuSign\eSign\Model\TemplateRole();
//            $templateRole->setEmail("[SIGNER_EMAIL]");
//            $templateRole->setName("[SIGNER_NAME]");
//            $templateRole->setRoleName("[ROLE_NAME]");


            $envelop_summary = $templateApi->createTemplate($accountId,$envelope_definition);
            if(!empty($envelop_summary))
            {
                echo "$envelop_summary";
            }


        }

    }
}
else{
    echo "Som tin Wong";
}
print_r($envelope_definition);