<?php

// provide functions to manage user registration
class UserRegister extends UserManager
{

    private static array $formFields = [
        //  label                       type            name                properties                          classes
        ["Nom",                         "text",         "nom",              "required",                         ""],
        ["Prénom",                      "text",         "prenom",           "required",                         ""],
        ["Email",                       "email",        "mail",             "required",                         ""],
        ["Ville",                       "text",         "ville_name",       "required autocomplete='off'",      "suggestion_ville_name"],
        ["Mot de passe",                "password",     "password",         "required",                         ""],
        ["Retaper le mot de passe",     "password",     "password_check",   "required",                         ""]
        // !! un field 'villeId' est également ajouté par l'ajax qui autocomplete le nom de la ville
    ];

    // défini des constantes pour simplifier l'acces aux fields, par exemple: $fields[0][LABEL]
    const LABEL       = 0;
    const TYPE        = 1;
    const NAME        = 2;
    const PROPERTIES  = 3;
    const CLASSES     = 4;

    public static function getFormFields(): array
    {

        return self::$formFields;
    }

    public static function handleRegisterPost(array $post): bool
    {
        $isAdded = false;

        $adBD = new AdherentBD();
        $ad = new Adherent();

        $ad = self::handleRegisterInputs($post);

        $mdp = isset($post['password']) ? $post['password'] : "";
        $mdp_check = isset($post['password_check']) ? $post['password_check'] : "";

        $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $valid_mdp = password_verify($mdp_check, $hash_mdp);

        $valid_mail = !self::isEmailInBD($ad->mail);

        if ($valid_mail && $valid_mdp) {
            $ad->password = $hash_mdp;
            $ad->numero_adherent = Utilities::generateUniqueNumber($ad->mail);
            $ad->numero_billet = Utilities::generateUniqueTicketNumber();
            $isAdded = $adBD->add($ad);
            Router::redirect('accueil');
            // Le $session current url ramenait à la page d'inscription si on se connecte juste après
            // De cette manière, on est renvoyé à l'accueil et ce n'est pas bizarre
            // Prévoir soit un popup de confirmation de création de compte ou une page de confirmation
            die();
        } else {
            $message = "";
            $message .= $valid_mail ? "" : "Cette adresse mail est déjà utilisée par un autre utilisateur.\\n";
            $message .= $valid_mdp ? "" : "Le mot de passe de confimation ne conrespond pas.";
            Utilities::alerte($message);
        }

        return $isAdded;
    }

    private static function handleRegisterInputs(array $post): Adherent
    {
        $ad = new Adherent();

        $nom    = isset($post['nom'])      ? $post['nom']       : "";
        $prenom = isset($post['prenom'])   ? $post['prenom']    : "";
        $mail   = isset($post['mail'])     ? $post['mail']      : "";
        $ville  = isset($post['ville_id']) ? $post['ville_id']  : "0";

        $ad->nom        = Utilities::sanitaze($nom);
        $ad->prenom     = Utilities::sanitaze($prenom);
        $ad->mail       = Utilities::sanitaze($mail);
        $ad->id_ville   = intval($ville);

        return $ad;
    }


    private static function generatePDF(Adherent $ad) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Nom: ' . $ad->nom);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Prenom: ' . $ad->prenom);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Numero Adherent: ' . $ad->numero_adherent);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Numero Billet: ' . $ad->numero_billet);
        $pdf->Ln();

        // Generate QR code
        $qrData = 'Adherent: ' . $ad->numero_adherent . ' - Billet: ' . $ad->numero_billet;
        $qrCode = \chillerlan\QRCode\QRCode::render($qrData);
        $pdf->Image('@' . $qrCode, 10, 60, 50, 50);

        $pdf->Output('D', 'ticket_' . $ad->numero_billet . '.pdf');
    }
}
