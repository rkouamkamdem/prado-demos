<div class="post-box">
    <h3>
        <com:THyperLink Text="<%# $this->Data->title %>"
                        NavigateUrl="prado-demos<%# $this->Service->constructUrl('posts.ReadPost',array('id'=>$this->Data->post_id)) %>"  target="_blank" />
    </h3>
    <p>
        Auteur:
        <com:TLiteral Text="<%# $this->Data->author->username %>" /><br/>
        Heure:
        <com:TLiteral Text="<%# date('m/d/Y h:m:sa', $this->Data->create_time) %>" />
    </p>
    <p>
        <com:TLiteral Text="<%# $this->Data->content %>" />
    </p>
</div>