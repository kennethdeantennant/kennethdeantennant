<?php
	// Create recipe object
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

	$recipeObj = new Recipe();

    require_once('../rtflite/lib/PHPRtfLite.php');

    // registers PHPRtfLite autoloader (spl)
    PHPRtfLite::registerAutoloader();

    // rtf document instance
    $rtf = new PHPRtfLite();

    // Set Page Settings
    PHPRtfLite_Unit::setGlobalUnit(PHPRtfLite_Unit::UNIT_INCH);  // inputs used as inches
    $rtf->setMargins(1.5, .5, .5, .5);   // margins: left, top, right, bottom
    $rtf->setPaperWidth(8.5);
    $rtf->setPaperHeight(11);

    $bodyFont = new PHPRtfLite_Font(10, 'Verdana', '#000000', '#FFFFFF');
    $bodyFontItalic = new PHPRtfLite_Font(10, 'Verdana', '#000000', '#FFFFFF');
    $bodyFontItalic->setItalic();
    $bodyFontBoldItalic = new PHPRtfLite_Font(10, 'Verdana', '#000000', '#FFFFFF');
    $bodyFontBoldItalic->setBold();
    $bodyFontBoldItalic->setItalic();
    

    // left-justified text
    $leftFormat = new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_LEFT);

    // centered text
    $centerFormat = new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER);

    // right-justified text
    $rightFormat = new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_RIGHT);

    // retrieve the categories
    $categories = $recipeObj->retrieveCategories();
    $categorySection = $rtf->addSection();
    while($categories && $category=mysql_fetch_array($categories))
    {
        $categorySection->writeText($category["name"], $bodyFont, $centerFormat);
        $categorySection->addEmptyParagraph(new PHPRtfLite_Font, new PHPRtfLite_ParFormat());
        
        // retrieve the recipes for a specific category
        $recipes = $recipeObj->retrieveRecipesByCategory($category["id"]);
        while($recipes && $recipe=mysql_fetch_array($recipes))
        {
            $recipeSection = $rtf->addSection();
            $categorySection->writeText($recipe["name"], $bodyFont, $leftFormat);
            
            // retrieve the ingredients for a specific recipe
            $enum = new PHPRtfLite_List_Enumeration($rtf);
            $ingredients=$recipeObj->retrieveRecipeDetailsByID($recipe["id"],"I");
            while($ingredients && $ingredient=mysql_fetch_array($ingredients))
            {
                $enum->addItem($ingredient["description"], $bodyFont);
            }
            $categorySection->addEnumeration($enum);
            
            // retrieve the directions for a specific recipe
            $font = new PHPRtfLite_Font('10', 'Verdana', '#f00');
            $numList = new PHPRtfLite_List_Numbering($rtf, null, $font);
            $directions=$recipeObj->retrieveRecipeDetailsByID($recipe["id"],"D");
            while($directions && $direction=mysql_fetch_array($directions))
            {
                $numList->addItem($direction["description"], $bodyFont);
            }
            $categorySection->addList($numList);
            
            // retrieve the tips for a specific recipe
            if( strlen($recipe["tips"]) > 0 ){
                $categorySection->addEmptyParagraph(new PHPRtfLite_Font, new PHPRtfLite_ParFormat());
                if( substr( $recipe["tips"], 0, 9 ) === "Comments:" || substr( $recipe["source"], 0, 9 ) === "comments:" ){
                    $categorySection->writeText($recipe["tips"], $bodyFontBoldItalic, $leftFormat);
                }else{
                    $comments = "Comments: ".$recipe["tips"];
                    $categorySection->writeText($comments, $bodyFontBoldItalic, $leftFormat);
                }
            }

            // retrieve the sources for a specific recipe
            if( strlen($recipe["source"]) > 0 ){
                //$categorySection->addEmptyParagraph(new PHPRtfLite_Font, new PHPRtfLite_ParFormat());
                //$categorySection->writeText("Source:", $bodyFontBoldItalic, $leftFormat);
                //$categorySection->writeText($recipe["source"], $bodyFontBoldItalic, $leftFormat);
            }
            
            $categorySection->addEmptyParagraph(new PHPRtfLite_Font, new PHPRtfLite_ParFormat());            
        }        
    }

    $rtf->save('../rtflite/RecipeBook.rtf');
    
    echo("RecipeBook.rtf is created");
?>