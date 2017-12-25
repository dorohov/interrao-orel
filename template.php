<?

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
	die();
}

use \Bitrix\Main\Localization\Loc as Bitrix__Loc;

Bitrix__Loc::loadMessages(__FILE__);

//azbn_ed($arResult['ITEM']);

?>

<div class="content-block about-page__content-block" role="main"> 
	<div class="container content-block__container about-page__container">
		<div class="category-panel__panel">
			<div class="category-panel__row row  is--wrap  is--gutter  is--jcc">
				<div class="category-panel__cols cols  is--cols-screen-4  is--aside">
					
					<?
					$APPLICATION->IncludeComponent(
						'interrao:info.menu',
						'',
						array(
							'IBLOCK_ID' => $arParams['IBLOCK_ID'],
							'ACTIVE_ITEM_ID' => $arResult['ITEM']['ID'],
							//'ROOT_MENU_TYPE' => 'section_about',	// Тип меню
							//'TEMPLATE' => 'section_about_left',
							//'ACTIVE_ITEM' => $arResult['ITEM'],
						),
						null,
						array(
							
						)
					);
					?>
					
				</div>
				<div class="category-panel__cols cols  is--cols-12  is--cols-screen-8">
					<div class="breadcrumb__block  is--heading">
						<ul class="breadcrumb__list  is--heading">
							<li class="breadcrumb__list-item">
								<a href="/" class="breadcrumb__list-link">Главная</a>
								<span class="breadcrumb__list-icon"><svg class="icon-svg icon-bread-icon" role="img">
									<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/img/svg/sprite.svg#bread-icon"></use>
								</svg></span>
							</li>
							<?
							$__block = CIBlock::GetByID($arParams['IBLOCK_ID']);
							if($__block__item = $__block->GetNext()) {
								azbn_ed($__block__item);
							?>
							<li class="breadcrumb__list-item">
								<a href="/about/" class="breadcrumb__list-link"><?=$__block__item['NAME'];?></a>
								<span class="breadcrumb__list-icon"><svg class="icon-svg icon-bread-icon" role="img">
									<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/img/svg/sprite.svg#bread-icon"></use>
								</svg></span>
							</li>
							<?
							}
							?>
							<li class="breadcrumb__list-item  is--active"><?=$arResult['ITEM']['NAME'];?></li>
						</ul>
					</div>
					
					
					<div class="page-header__block  is--heading-card">
						<h1  class="page-header__heading  is--heading-card">
							<?
							if(isset($arResult['ITEM']['UF_HEADER']) && $arResult['ITEM']['UF_HEADER'] != '') {
								echo $arResult['ITEM']['UF_HEADER'];
							} else {
								echo $arResult['ITEM']['NAME'];
							}
							?>
						</h1>
					</div>
					
					
					<div class="category-panel__inner">
						
						<div class="category-panel__elem">
							<div class="text__block">
								<?=$arResult['ITEM']['~DESCRIPTION'];?>
							</div>
						</div>
						
						<?
						if(count($arResult['CHILDREN'])) {
						?>
						
						<div class="category-panel__elem">						
							<div class="table-block__panel">
								
								<?
								foreach($arResult['CHILDREN'] as $item) {
								?>
								<div class="table-block__card">
									<div class="page-header__block  is--card">
										<h3  class="page-header__heading  is--card"><?=$item['NAME'];?></h3>		
									</div>
									<div class="table-responsive">
										<?=$item['~DESCRIPTION'];?>
									</div>	
								</div>
								<?
								}
								?>
								
							</div>
						</div>	
						
						<?
						}
						?>
						
						<?
						if(count($arResult['ITEMS'])) {
						?>
						
						<div class="category-panel__elem">	
							<div class="docs-panel__block">
								<div class="docs-panel__row row  is--wrap  is--gutter">
									
									<?
									foreach($arResult['ITEMS'] as $item) {
										
										//$item = CFile::GetByID($item_id);
										//$item = $item->Fetch();
										
										if(isset($item['~PROPERTY_ATTACHMENT_FILE_VALUE']) && $item['~PROPERTY_ATTACHMENT_FILE_VALUE'] != '') {
											
											//$attach = CFile::GetByID($item['~PROPERTY_ATTACHMENT_FILE_VALUE']);
											//$attach = $attach->Fetch();
											
											$link = CFile::GetPath($item['~PROPERTY_ATTACHMENT_FILE_VALUE']);
											
										} else {
											
											$link = $item['DETAIL_PAGE_URL'];
											
										}
										
									?>
									<div class="docs-panel__cols cols  is--cols-sm-6  is--cols-screen-6">
										<a href="<?=$link;?>" class="btn-link__item  is--download" >
											<span class="btn-link__item-name"><?=$item['NAME'];?></span>
											<span class="btn-link__item-icon  is--download"><svg class="icon-svg icon-icon-download" role="img">
												<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/img/svg/sprite.svg#icon-download"></use>
											</svg></span>
										</a>
									</div>
									<?
									}
									?>
									
								</div>
							</div>
						</div>
						
						<?
						}
						?>
						
						<?
						/*
						if(is_array($arResult['ITEM']['UF_FILES']) && count($arResult['ITEM']['UF_FILES'])) {
						?>
						<div class="category-panel__elem">	
							<div class="docs-panel__block">
								<div class="docs-panel__row row  is--wrap  is--gutter">
									
									<?
									foreach($arResult['ITEM']['UF_FILES'] as $item_id) {
										
										$item = CFile::GetByID($item_id);
										$item = $item->Fetch();
										
										azbn_ed($item);
										
									?>
									<div class="docs-panel__cols cols  is--cols-sm-6  is--cols-screen-6">
										<a href="##"    class="btn-link__item  is--download">
											<span class="btn-link__item-name">Районные подразделения компании</span>
											<span class="btn-link__item-icon  is--download"><svg class="icon-svg icon-icon-download" role="img">
											<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/img/svg/sprite.svg#icon-download"></use>
										</svg></span>
										</a>
									</div>
									<?
									}
									?>
									
								</div>
							</div>
						</div>
						<?
						}*/
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>