<html>
<com:THead />
<body>
<com:TForm>
    <div id="page">
        <div id="header">
            <h1>Mon blog PRADO</h1>
        </div>
        <div id="main">
            <com:TContentPlaceHolder ID="Main" />
        </div>
        <div id="footer">
            <com:THyperLink Text="Accueil" SkinID="MainMenu"
                            NavigateUrl="prado-demos<%= $this->Service->DefaultPageUrl %>" />
            <com:THyperLink Text="Nouveau message" SkinID="MainMenu"
                            NavigateUrl="prado-demos<%= $this->Service->constructUrl('posts.NewPost') %>"
                            Visible="<%= !$this->User->IsGuest %>" />
            <com:THyperLink Text="Nouvel utilisateur" SkinID="MainMenu"
                            NavigateUrl="prado-demos<%= $this->Service->constructUrl('users.NewUser') %>"
                            Visible="<%= $this->User->IsAdmin %>" />
            <com:THyperLink Text="Liste des utilisateurs" SkinID="MainMenu"
                            NavigateUrl="prado-demos<%= $this->Service->constructUrl('users.ListUser') %>"
                            Visible="<%= $this->User->IsAdmin %>" />
            <com:THyperLink Text="Liste des messages" SkinID="MainMenu"
                            NavigateUrl="prado-demos<%= $this->Service->constructUrl('posts.ListPost') %>"
                            Visible="<%= $this->User->IsAdmin %>" />
            <com:THyperLink Text="Se connecter" SkinID="MainMenu" NavigateUrl="/prado-demos<%= $this->Service->constructUrl('users.LoginUser') %>" Visible="<%= $this->User->IsGuest %>" />
            <com:TLinkButton Text="Se déconnecter" OnClick="logoutButtonClicked" Visible="<%= !$this->User->IsGuest %>" />
          <!--  <com:TButton Text="Se déconnecter" OnClick="logoutButtonClicked" Visible="<%= !$this->User->IsGuest %>" />  Ceci nest un bouton de type submit -->
            <br/><br/><br/>
            <%= PRADO::poweredByPrado() %>
        </div>
    </div>
</com:TForm>
</body>
</html>