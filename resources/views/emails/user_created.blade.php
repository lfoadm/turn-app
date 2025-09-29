<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turn-app - Senha temporária</title>
</head>
<body style="background-color: #f5f7fa; font-family: 'Inter', Arial, sans-serif; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; mso-text-size-adjust: 100%;">

    <!-- Container Principal -->
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); border: 1px solid #e0e6ed;">
        
        <!-- HEADER -->
        <div style="background-color: #1D2939; padding: 20px; text-align: center;">
            <h1 style="color: white; font-size: 24px; margin: 0; letter-spacing: 1px;">Turn-app</h1>
        </div>

        <!-- CORPO -->
        <div style="padding: 30px 40px;">
            
            <h2 style="color: #333333; font-size: 22px; margin-top: 0; margin-bottom: 20px; font-weight: 600;">Novo cadastro</h2>
            
            <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                Olá, <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>, <br/><br/>
                Sua conta foi criada no sistema. <br>
                Use este e-mail e a senha temporária para acessar:
            </p>

            <p style="font-size: 16px; color: #333333; margin: 15px 0;">
                <strong>Senha temporária:</strong> {{ $password }}
            </p>

            <!-- BOTÃO DE LOGIN -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/login') }}" 
                   style="display: inline-block; background-color: #1D2939; color: #ffffff; font-size: 16px; font-weight: bold; padding: 14px 28px; text-decoration: none; border-radius: 6px;">
                    Acessar minha conta
                </a>
            </div>

            <p style="color: #666666; font-size: 14px; line-height: 1.5;">
                No primeiro acesso, será solicitado que você altere sua senha para maior segurança.
            </p>

            <!-- Aviso de Segurança -->
            <p style="color: #999999; font-size: 13px; text-align: center; border-top: 1px solid #eeeeee; padding-top: 20px; margin-top: 20px;">
                <strong>Segurança:</strong> Se você não solicitou este cadastro, ignore este e-mail.
            </p>
        </div>

        <!-- FOOTER -->
        <div style="background-color: #e0e6ed; padding: 20px; text-align: center;">
            <p style="color: #888888; font-size: 12px; margin: 0;">
                © 2025 Turn-app. Todos os direitos reservados.
            </p>
        </div>
    </div>

</body>
</html>
