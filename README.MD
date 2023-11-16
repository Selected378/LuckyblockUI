Si vous souhaitez mettre un item customies veuillez faire comme sa :

éxemple :

Remplacez cette ligne :
 $item = VanillaItems::DIAMOND_SWORD();

 Par : 

 $item = CustomiesItemFactory::getInstance()->get("Nom de L'item", Quantité);

 Je rapelle que c'est qu'un éxemple