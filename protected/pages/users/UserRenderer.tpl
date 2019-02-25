<div class="post-box">
    <h3>
        <com:THyperLink Text="<%# $this->Data->username %>"
                        NavigateUrl="prado-demos<%# $this->Service->constructUrl('users.ReadUser',array('username'=>$this->Data->username)) %>"  target="_blank" />
    </h3>
    <p>
        Email:
        <com:TLiteral Text="<%# $this->Data->email %>" /><br/>
        Firstname:
        <com:TLiteral Text="<%# $this->Data->first_name %>" />
        Lastname:
        <com:TLiteral Text="<%# $this->Data->last_name %>" />
        Role:
        <com:TLiteral Text="<%# ( $this->Data->role == 0 ) ? 'USER' : 'ADMIN' %>" />
    </p>

</div>