
package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

@Entity
@Table(name="TiempoLimiteCodigo", schema="dayclass")
public class TiempoLimiteCodigo implements Serializable {
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private int minutosLimite;
    
    public TiempoLimiteCodigo() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    
    public int getMinutosLimite() {
        return minutosLimite;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setMinutosLimite(int minutosLimite) {
        this.minutosLimite = minutosLimite;
    }
    
    
}
