window.addEventListener("load",function() {
 
    var Q = Quintus({
        imagePath: '../views/battle/images/',
        dataPath: '../views/battle/data/'
    }).include("Sprites,UI,Input,Touch,Anim,Scenes,2D").setup("example1").controls().touch();
      
    var redSequ = ['kick', 'evade', 'kick', 'punch'];
    var blueSequ = ['evade', 'punch', 'evade', 'kick'];
    var waiting = false; var speed = 0.5;
    
    Q.Sprite.extend("Bot", {
        init: function(p) {
            this._super(p, {
                frame: 2,
                y: 250,
                scale: 0.65,
                index: 0,
                point: 0,
                hp: 100,
                end: false
            });
            
            this.add("tween");
            this.on('fight', this, 'fight');
            this.on('punch', this, 'punch');
            this.on('kick', this, 'kick');
            this.on('block', this, 'block');
            this.on('evade', this, 'evade');
            this.on('end', this, 'end');
        },
        
        moveBy: function(posX){
            if(this.p.face){
                return this.p.x + posX;
            }else{
                return this.p.x - posX;
            }
        },
        
        hit: function(damage){
            this.p.hp -= damage;
            this.p.bar.hit(this.p.hp);
        },
        
        move: function(){
            if(this.p.sheet == 'red'){
                ot = enemy;
            }else if(this.p.sheet == 'blue'){
                ot = player;
            }
            
            if(ot.p.seq.length > ot.p.index){
                if(ot.p.seq[this.p.index] == 'block'){
                    if(this.p.seq[this.p.index] == 'kick'){
                        ot.hit(15);
                    }

                    if(this.p.seq[this.p.index] == 'punch'){
                        ot.hit(10);
                    }
                }else if(ot.p.seq[this.p.index] == 'punch'){
                    if(this.p.seq[this.p.index] == 'kick'){
                        ot.hit(20);
                    }

                    if(this.p.seq[this.p.index] == 'punch'){
                        ot.hit(15);
                    }
                }else if(ot.p.seq[this.p.index] == 'kick'){
                    if(this.p.seq[this.p.index] == 'kick'){
                        ot.hit(15);
                    }

                    if(this.p.seq[this.p.index] == 'punch'){
                        ot.hit(10);
                    }
                }
            }else{
                if(this.p.seq[this.p.index] == 'kick'){
                    ot.hit(25);
                }

                if(this.p.seq[this.p.index] == 'punch'){
                    ot.hit(20);
                }
            }
            
            this.trigger(this.p.seq[this.p.index]); this.p.index++;
        },
        
        fight: function(){
            this.p.frame = 2;
            this.animate({ x: this.moveBy(150) }, speed, {
                callback: function(){
                    this.move();
                    Q.stageScene('hud', 3, { y: 100, text: "" });
                } 
            });
        },
        
        punch: function(){
            this.p.frame = 1;
            this.animate({ x: this.moveBy(250) }, speed).chain({ x: this.p.pos }, speed, {
                callback: function(){
                    this.p.frame = 2;
                    if(this.p.index < this.p.seq.length){
                        this.move();
                    }else{
                        this.p.end = true;
                        player.trigger('endGame');
                    }
                } 
            });
        },
        
        kick: function(){
            this.p.frame = 4;
            this.animate({ x: this.moveBy(250) }, speed).chain({ x: this.p.pos }, speed, {
                callback: function(){
                    this.p.frame = 2;
                    if(this.p.index < this.p.seq.length){
                        this.move();
                    }else{
                        this.p.end = true;
                        player.trigger('endGame');
                    }
                } 
            });
        },
        
        block: function(){
            this.p.frame = 3;
            this.animate({ x: this.moveBy(-100) }, speed).chain({ x: this.p.pos }, speed, {
                callback: function(){
                    this.p.frame = 2;
                    if(this.p.index < this.p.seq.length){
                        this.move();
                    }else{
                        this.p.end = true;
                        player.trigger('endGame');
                    }
                } 
            });
        },
        
        evade: function(){
            this.p.frame = 0;
            this.animate({ x: this.moveBy(-150) }, speed).chain({ x: this.p.pos }, speed, {
                callback: function(){
                    this.p.frame = 2;
                    if(this.p.index < this.p.seq.length){
                        this.move();
                    }else{
                        this.p.end = true;
                        player.trigger('endGame');
                    }
                } 
            });
        },
        
        end: function(){
            this.animate({ x: this.moveBy(-100) }, speed, { callback: function(){
                this.p.frame = 3;
                this.p.end = false;
//                player.trigger('endGame');
                this.p.index = 0;
            }});
        }
    });

    Q.Sprite.extend("HpBar", {
        init: function(p){
            this._super(p, {
                w: 0,
                h: 35,
                y: 40
            });
            this.add("tween");
        },
        draw: function(ctx){
            ctx.fillStyle = this.p.color;
            ctx.fillRect(-this.p.cx,-this.p.cy,this.p.w,this.p.h);
        },
        hit: function(hp){
            if(hp > 0){
                width = 350 * hp / 100;
                this.animate({ w: width}, 0.25);
            }else if(hp <= 0){
                this.animate({ w: 0}, 0.25);
            }
        }
    });
    
    Q.scene('Game', function(stage) {        
		enemy = stage.insert(new Q.Bot({
            sheet: "blue", 
            x : 700,
            pos : 550,
            face: false,
            seq: blueSequ,
            bar: stage.insert(new Q.HpBar({
                x: 775,
                color: '#3872f4',
                flip: "x"
            }))
        }));
        
        player = stage.insert(new Q.Bot({
            sheet: "red", 
            flip: "x", 
            x: 100,
            pos: 250,
            face: true,
            seq: redSequ,
            bar: stage.insert(new Q.HpBar({
                x: 25,
                color: '#f43838'
            }))
        }));
        
        player.on('endGame', function(){
            if(player.p.end && enemy.p.end){
                if(player.p.hp > enemy.p.hp){
                    Q.stageScene('hud', 3, { y: 100, text: "You Win\nSpace to Replay" });
                    if(enemy.p.hp <= 0){
                        var result = 'perfect';
                    }else{
                        var result = 'good';
                    }
                }else if(player.p.hp < enemy.p.hp){
                    Q.stageScene('hud', 3, { y: 100, text: "You Lose\nSpace to Replay" });
                    var result = 'none';
                }
                
                player.trigger('end');
                enemy.trigger('end');
                
                var idBattle = $('div[battle-id]').attr('battle-id');
                var enid = $('.enid').attr('enid');
                var userid = $('#nameScript').attr('userid');
                if(idBattle != 'new'){
                    $.post( "upFight", { id: idBattle, result: result }).done(function(data) {
                        var lastres = $('div[battle-id]').attr('last-res');
                        $('div[battle-id]').removeClass(lastres).addClass(result);
                    }).fail(function(data) {
                        console.log('There is an error while trying to save data to database');
                    });
                }else{
                    $.post( "newBattle", { userid: userid, enemyid: enid, result: result }).done(function(data) {
                        var lastres = $('div[battle-id]').attr('last-res');
                        $('div[battle-id]').removeClass(lastres).addClass(result);
                    }).fail(function(data) {
                        console.log('There is an error while trying to save data to database');
                    });
                }
            }
        });
        
        player.on('resetGame', function(){
            player.p.hp = 100;
            player.p.x = 100;
            player.p.index = 0;
            
            enemy.p.hp = 100;
            enemy.p.x = 700;
            enemy.p.index = 0;
            
            player.p.bar.hit(0);
            enemy.p.bar.hit(0);
            
            Q.stageScene('hud', 3, { y: 40, text: "Press Space to Play" });
        });
        
        Q.input.on('fire',stage,function(e) {
            player.p.hp = 100;
            enemy.p.hp = 100;
            
            player.p.bar.hit(player.p.hp);
            enemy.p.bar.hit(enemy.p.hp);
            
            Q.stageScene('hud', 3, { y: 100, text: "Battle Start!" });
            
            player.trigger('fight');
            enemy.trigger('fight');
        });
	});
    
    Q.scene('hud', function(stage) {
        var container = stage.insert(new Q.UI.Container({
            y: stage.options.y,
            x: Q.width/2
        }));

        stage.insert(new Q.UI.Text({ 
          label: stage.options.text,
          color: "black",
          x: 0,
          y: 0
        }),container);

        container.fit(20,20);
    });
    
    Q.load("red.png, red.json, blue.png, blue.json",function() {
		Q.compileSheets("red.png","red.json");
        Q.compileSheets("blue.png","blue.json");
        Q.compileSheets("hud-red.png","red-hud.json");
        Q.compileSheets("hud-blue.png","blue-hud.json");
		Q.stageScene("Game");
        Q.stageScene('hud', 3, { y: 40, text: "Press Space to Play" });
        
        // Turn on default keyboard controls
        Q.input.keyboardControls();
	});
 
});