<main class="content">
    <header class="header-box">
        <h2 class="header-box-h">Gerencie as categorias de soluções do sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=categories-solution/create"><span class="lnr lnr-plus-circle"></span> Nova categoria</a>
        </div>
    </header>

    <div class="box">
        <table id="table-categories-produtct" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 100px"><span class="lnr lnr-layers"></span> Categoria</th>
                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>
                    <th style="width: 120px"><span class="lnr lnr-layers"></span> Subcategorias</th>
                    <th></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th><span class="lnr lnr-layers"></span> Categoria</th>
                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>
                    <th><span class="lnr lnr-layers"></span> Subcategorias</th>
                    <th></th> 
                </tr>
            </tfoot>
        </table>

        <div class="box_mobile">
            <?php
            $Read = new Read;
            $Read->FullRead("SELECT * FROM tb_categories_solution WHERE category_parent IS NULL");
            $Rows = $Read->getRowCount();
            $TotalRows = $Rows;

            foreach ($Read->getResult() as $dt):
                extract($dt);
                ?>
                <div class="bloco_mob">
                    <!--                    <div class="p_mob">
                    <?= $NomeEmpresa; ?>
                                        </div>-->
                    <div class="s_mob">
                        <div style="flex-basis: 100%;">
                            <span><small>Categoria:</small></span>
                            <span><?= $category_title; ?></span>
                        </div>
                        <div style="flex-basis: 100%;">
                            <span><small>Descrição:</small></span>
                            <span><?= $category_content; ?></span>
                        </div>
                        <div style="flex-basis: 100%;">
                            <span><small>Subcategorias:</small></span>
                            <span>
                                <?php
                                $Read->ExeRead("tb_categories_solution", "WHERE category_parent = :c", "c={$category_id}");
                                $parent = array();
//                                foreach ($Read->getResult() as $v):
//                                    $parent[] = " {$v['category_title']}";
//                                endforeach;
//                $parent = array();
                                foreach ($Read->getResult() as $v):
                                    $parent[] = " {$v['category_title']}";
//                    $parent[] = " {$v['category_title']}";
//                                    ($parent ? $parent : "<i style='color:#bbb;'>Não á uma subcategoria</i>");
//                                    ($v['category_title'] ? $v['category_title'] : "<i style='color:#bbb;'>Não á uma subcategoria</i>");
                                endforeach;
                                if ($parent) {
                                    $r = (implode(' <b>/</b> ', $parent));
                                    echo $r;
                                } else {
                                    echo "<i style='color:#bbb;'>Não á uma subcategoria</i>";
                                }
                                ?>
                            </span>
                        </div>
                        <!--                        <div style="    
                                                         display: flex;
                                                         width: 100%;
                                                         justify-content: space-between;">
                                                        <div>
                                                            <span><small>Data:</small></span>
                                                            <span><?= date("d/m/Y", strtotime($DataRelatorio)); ?></span>
                                                        </div>
                                                        <div>
                                                            <span><small>Código:</small></span>
                                                            <span><?= $CodigoRelatorio; ?></span>
                                                        </div>
                                                    </div>
                                                    <div style="flex-basis: 100%;">
                                                        <span><small>Descrição:</small></span>
                                                        <span><?= Check::Words($DescServicoRelatorio, 5); ?></span>
                                                    </div>
                                                    <div>
                                                        <span><small>Hr Total:</small></span>
                                                        <span><?= $HTotalRelatorioText; ?></span>
                                                    </div>-->
                    </div>
                    <div class="t_mob">

                    </div>
                    <div class="q_mob">
                        <div>
                            <button name='btn-href[]' data-href='?exe=categories-solution/update&category=<?php $category_id ?>' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> 
                            <button name='btn-modal[]' data-function='categories-solution-delete' value='<?php $category_id ?>' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>

                        </div>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</main>