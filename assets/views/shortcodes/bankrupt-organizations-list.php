<section id="content_w">

    <div class="text_content">
        <div class="filter_podobrat">
            <div class="visible-xs">
                <button type="button" id="popupfilter">Фильтр по параметрам</button>
            </div>
            <form method="get" action="#">
                <div class="visible-xs">
                    <div class="head_mobile">
                        <div class="title">
                            Фильтр по параметрам
                        </div>
                        <button type="button" class="close"></button>
                    </div>
                </div>


                <div class="column4">
                    <div class="select">
                        <select name="city">
                            <option value="0">Выберите город</option>
                            <?php foreach ($citys as $city) {
                                $selected = '';
                                if($city == $selectedCity) $selected = 'selected';
                                ?>
                                <option <?= $selected ?>><?= $city ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="select">
                        <select name="ifns">
                            <option value="0">Выберите ИФНС</option>
                            <?php foreach ($ifns as $ifns_) {
                                $selected = '';
                                if($ifns_ == $selectedIfn) $selected = 'selected';?>
                                <option <?= $selected ?>><?= $ifns_ ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="column4">
                    <div class="select">
                        <select name="okwed">
                            <option value="0">Выберите ОКВЭД</option>
                            <?php foreach ($okweds as $okwed) {
                                $selected = '';
                                if($okwed == $selectedOkwed) $selected = 'selected';
                                ?>
                                <option <?= $selected ?>><?= $okwed ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="select">
                        <select name="vid">
                            <option value="0">Вид деятельности</option>
                            <?php foreach ($vids as $vid) {
                                $selected = '';
                                if($vid == $selectedVid) $selected = 'selected';
                                ?>
                                <option <?= $selected ?>><?= $vid ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="column4 sec">
                    <b>Налоги</b>

                    <label><input type="checkbox" name="nalog[]"
                            <?= isset($_GET['nalog']) ?
                                (in_array('УСН 15%',$_GET['nalog'] ) ? "checked" : "") : ''?>
                                  value="УСН 15%"><i></i>УСН 15%</label>
                    <label><input type="checkbox" name="nalog[]"
                            <?= isset($_GET['nalog']) ?
                                (in_array('УСН 6%',$_GET['nalog'] ) ? "checked" : "") : '' ?>
                                  value="УСН 6%"><i></i>УСН 6%</label>
                    <label><input type="checkbox" name="nalog[]"
                            <?= isset($_GET['nalog']) ?
                                (in_array('ОСНО',$_GET['nalog'] ) ? "checked" : "") : '' ?>
                                  value="ОСНО"><i></i>ОСНО</label>
                </div>
                <div class="column4 sec">
                    <b>Обороты</b>
                    <label><input type="checkbox" name="oboroti[]"
                                  <?= isset($_GET['oboroti']) ?
                                      (in_array('До 100 млн. руб.',$_GET['oboroti'] ) ? "checked" : "") : '' ?>
                                  value="До 100 млн. руб."><i></i>До 100 млн.
                        руб.</label>
                    <label><input type="checkbox" name="oboroti[]"
                                  <?= isset($_GET['oboroti']) ?
                                      (in_array('Без оборотов',$_GET['oboroti'] ) ? "checked" : "") : '' ?>
                                  value="Без оборотов"><i></i>Без оборотов</label>
                    <label><input type="checkbox" name="oboroti[]"
                                  <?= isset($_GET['oboroti']) ?
                            (in_array('Больше 100 млн. руб',$_GET['oboroti'] ) ? "checked" : "") : '' ?> value="Больше 100 млн. руб"><i></i>Больше 100 млн.
                        руб</label>
                </div>
                <div class="column">
                    <a href="<?= explode('?', $_SERVER['REQUEST_URI'], 2)[0] ?>" class="">Сбросить</a>
                    <button type="submit" class="find">Показать предложения</button>
                </div>
            </form>
        </div>


        <div class="result_filter">
            <div class="title">Каталог готовых фирм</div>
            <div class="scroll">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <td>Наименование</td>
                        <td>Дата <br>рег-ции</td>
                        <td>Город</td>
                        <td>ИФНС</td>
                        <td>Налоги</td>
                        <td>ОКВЭД</td>
                        <td>Обороты</td>
                        <td>Цена</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if($countOrganizations < 1) {?>
                        <h3>По вашому запросу огранизаций не найдено</h3>
                    <?php } else {

                    for($i = 0; $i < $countOrganizations; $i++) {
                        ?>

                    <tr>
                        <td>
                            <a href="<?= $organizations[$i]['link'] ?>">
                               <?= $organizations[$i]['post']->post_title ?>
                            </a>
                        </td>
                        <td><?php
                            if(isset($organizations[$i]['meta']['datareg'][0])) { ?>
                            <?= $organizations[$i]['meta']['datareg'][0] ?>
                            <?php
                            } else { ?>
                                -
                            <?php }
                            ?></td>
                        <td><?= $organizations[$i]['meta']['city'][0] ?></td>
                        <td><?php if(isset($organizations[$i]['meta']['ifns'][0])) { ?>
                            <?= $organizations[$i]['meta']['ifns'][0] ?>
                            <?php
                            } else { ?>
                                -
                            <?php } ?></td>
                        <td><?php if(isset($organizations[$i]['meta']['nalog'][0])) { ?>
                            <?= $organizations[$i]['meta']['nalog'][0] ?>
                            <?php
                            } else { ?>
                                -
                            <?php }
                            ?></td>
                        <td><?php if(isset($organizations[$i]['meta']['okwedm'][0])) { ?>
                                <?= $organizations[$i]['meta']['okwedm'][0] ?>
                                <?php
                            } else { ?>
                                -
                            <?php }
                            ?></td>
                        <td><?php if(isset($organizations[$i]['meta']['oboroti'][0])) { ?>
                                <?= $organizations[$i]['meta']['oboroti'][0] ?>
                                <?php
                            } else { ?>
                                -
                            <?php }
                            ?></td>
                        <td><?php if(isset($organizations[$i]['meta']['price'][0])) { ?>
                                <?= $organizations[$i]['meta']['price'][0] ?>
                                <?php
                            } else { ?>
                                -
                            <?php }
                            ?></td>
                    </tr>
                    <?php }
        } ?>

            </tbody>
        </table>
    </div>


        </div>


        <div class="pagination_block">
        </div>
    </div>
</section>

<?php //var_dump($organizations); ?>