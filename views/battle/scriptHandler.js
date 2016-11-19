var scriptHandler = function(code) {
    this.script = code;
    this.sequence = function () {
        seq = new Array();
        i = 0;
        
        Block = function (){
            seq[i] = 'block';
            i++;
        }

        Evade = function (){
            seq[i] = 'evade';
            i++;
        }

        Punch = function (){
            seq[i] = 'punch';
            i++;
        }

        Kick = function (){
            seq[i] = 'kick';
            i++;
        }

        running = Function(this.script);
        running();
        
        return seq;
    };
};