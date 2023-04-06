<form
    class="search-form"
    role="search"
    method="get"    
    action="<?php echo home_url('/') ?>"
>
    <input
        class="search-form__input"
        type="text"
        value="<?php echo get_search_query() ?>"
        name="s" 
        placeholder="Найти..."
        autocomplete="off"
    />
    <button type="submit" id="searchsubmit">
        <img src="<?php echo get_template_directory_uri() . '/images/icons/search.svg' ?>">
    </button>
</form>
